<?php 
    add_action( 'wp_enqueue_scripts', function() {
        
        //  if( is_page( 96 )  || is_page( 152)){
        //     wp_enqueue_style( 'not-main', get_template_directory_uri() . '/assets/styles/not-main.css');
        // }

        
        // wp_enqueue_style( 'bootstrap', get_template_directory_uri() . 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css');
        // wp_enqueue_style( 'font-popins', get_template_directory_uri() . 'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap');
        // wp_enqueue_style( 'font-awesome.min', get_template_directory_uri() . 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
       
        
       
        
        
        wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.css');
        wp_enqueue_style( 'my-styles', get_template_directory_uri() . '/assets/css/my-styles.css');
        wp_enqueue_style( 'yur-styles', get_template_directory_uri() . '/assets/css/yur-styles.css');


        wp_enqueue_style( 'nice-select', get_template_directory_uri() . '/assets/css/nice-select.css');

        wp_enqueue_style( 'font-awesome.min', get_template_directory_uri() . '/assets/css/font-awesome.min.css');

        wp_enqueue_style( 'bootstrap-grid', get_template_directory_uri() . '/assets/css/bootstrap-grid.css');

        wp_enqueue_style( 'slick.min', get_template_directory_uri() . '/assets/css/slick.min.css');
        wp_enqueue_style( 'basket', get_template_directory_uri() . '/assets/css/basket.css');
       
        
        wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css');


 

       


        wp_deregister_script( 'jquery' );
	    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js');
	    wp_enqueue_script( 'jquery' );


        // wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.js', array('jquery'), 'null', true );
        wp_enqueue_script( 'jquery-2.2.4.min', get_template_directory_uri() . '/assets/js/jquery-2.2.4.min.js', array('jquery'), 'null', true );


        wp_enqueue_script( 'slick.min', get_template_directory_uri() . '/assets/js/slick.min.js', array(), 'null', true );

   

        wp_enqueue_script( 'jquery.fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.js', array('jquery'), 'null', true );

        wp_enqueue_script( 'jquery.nice-select', get_template_directory_uri() . '/assets/js/jquery.nice-select.js', array('jquery'), 'null', true );
        
        
        wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.js', array(), 'null', true );


        
        wp_enqueue_script( 'my-js', get_template_directory_uri() . '/assets/js/my-js.js', array(), 'null', true );

        wp_enqueue_script( 'lazyload.min', get_template_directory_uri() . '/assets/js/lazyload.min.js', array(), 'null', true );
    wp_enqueue_script( 'domHelper', get_template_directory_uri() . '/assets/js/helpers/domHelper.js', array(), 'null', true );

        wp_enqueue_script( 'fizProductData', get_template_directory_uri() . '/assets/js/data/fizProductData.js', array(), 'null', true );
         wp_enqueue_script( 'basket', get_template_directory_uri() . '/assets/js/basket.js', array(), 'null', true );
         wp_localize_script( 'basket', 'inmiBasketOrder', array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'inmi_send_order' ),
        ) );


        wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), 'null', true );




        
        
       
        
       

        
        
        
        
        });

        
    

        


    add_theme_support( 'post-thumbnails');
    add_theme_support( 'custom-logo');
    add_theme_support( 'title-tag');





add_filter( 'upload_mimes', 'svg_upload_allow' );

# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}




add_action( 'wp_ajax_inmi_send_order', 'inmi_send_order' );
add_action( 'wp_ajax_nopriv_inmi_send_order', 'inmi_send_order' );

function inmi_send_order() {
    check_ajax_referer( 'inmi_send_order', 'nonce' );

    $firstname = sanitize_text_field( wp_unslash( $_POST['firstname'] ?? '' ) );
    $email = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
    $telephone = sanitize_text_field( wp_unslash( $_POST['telephone'] ?? '' ) );
    $shipping = sanitize_text_field( wp_unslash( $_POST['shipping'] ?? '' ) );
    $payment = sanitize_text_field( wp_unslash( $_POST['payment'] ?? '' ) );
    $address = sanitize_text_field( wp_unslash( $_POST['address'] ?? '' ) );
    $comment = sanitize_textarea_field( wp_unslash( $_POST['comment'] ?? '' ) );
    $total = sanitize_text_field( wp_unslash( $_POST['total'] ?? '' ) );
    $products_json = wp_unslash( $_POST['products'] ?? '[]' );
    $products = json_decode( $products_json, true );

    if ( ! is_array( $products ) ) {
        $products = array();
    }

    if ( empty( $firstname ) || empty( $email ) || empty( $telephone ) || empty( $products ) ) {
        wp_send_json_error( array( 'message' => 'Заполните обязательные поля и проверьте корзину.' ), 400 );
    }

    $message_lines = array(
        'Новый заказ с сайта ' . wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ),
        '',
        'Покупатель:',
        'ФИО: ' . $firstname,
        'Email: ' . $email,
        'Телефон: ' . $telephone,
        '',
        'Доставка и оплата:',
        'Способ доставки: ' . $shipping,
    );

    if ( ! empty( $address ) ) {
        $message_lines[] = 'Адрес доставки: ' . $address;
    }

    $message_lines[] = 'Способ оплаты: ' . $payment;

    if ( ! empty( $comment ) ) {
        $message_lines[] = 'Комментарий: ' . $comment;
    }

    $message_lines[] = '';
    $message_lines[] = 'Состав заказа:';

    foreach ( $products as $index => $product ) {
        $title = sanitize_text_field( $product['title'] ?? '' );
        $count = absint( $product['count'] ?? 0 );
        $price = (float) ( $product['price'] ?? 0 );
        $line_total = $price * $count;

        if ( empty( $title ) || $count < 1 ) {
            continue;
        }

        $message_lines[] = sprintf(
            '%d. %s — %d шт. × %s BYN = %s BYN',
            $index + 1,
            $title,
            $count,
            number_format( $price, 2, '.', ' ' ),
            number_format( $line_total, 2, '.', ' ' )
        );
    }

    $message_lines[] = '';
    $message_lines[] = 'Итого: ' . $total . ' BYN';

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: INMI Order <andrey.buko@mail.ru>',
        'Reply-To: ' . $firstname . ' <' . $email . '>',
    );

    $sent = wp_mail(
        'andrew.buka90@gmail.com',
        'Новый заказ с сайта INMI',
        implode( "\n", $message_lines ),
        $headers
    );

    if ( ! $sent ) {
        wp_send_json_error( array( 'message' => 'Не удалось отправить заказ. Попробуйте позже.' ), 500 );
    }

    wp_send_json_success( array( 'message' => 'Спасибо! Ваш заказ успешно отправлен.' ) );
}


function inmi_is_current_template_file( $file ) {
    $template = basename( get_page_template_slug() ?: '' );
    if ( $template === $file ) {
        return true;
    }

    global $template;
    return ! empty( $template ) && basename( $template ) === $file;
}

function inmi_get_seo_defaults() {
    return array(
        'title'       => 'INMI — биопрепараты для сельского хозяйства, очистки воды и септиков',
        'description' => 'Белорусские биопрепараты INMI для силоса, растениеводства, животноводства, рыбоводства, очистки сточных вод и бытовых септиков.',
        'keywords'    => 'биопрепараты, INMI, биоконсерванты, микробные удобрения, бактерии для септика, кормовые добавки',
        'type'        => 'website',
    );
}

function inmi_get_template_seo_map() {
    return array(
        'home.php' => array(
            'title' => 'INMI — биопрепараты и микробиологические решения в Беларуси',
            'description' => 'Каталог биопрепаратов INMI: решения для сельского хозяйства, кормов, силосования, очистки воды, септиков и восстановления почв.',
            'keywords' => 'INMI, биопрепараты Беларусь, микробиологические препараты, биотехнологии',
        ),
        'yur-page.php' => array(
            'title' => 'Биопрепараты для юридических лиц — каталог B2B | INMI',
            'description' => 'Профессиональные биопрепараты INMI для хозяйств и предприятий: биоконсерванты, кормовые добавки, микробные удобрения, очистка воды и рыбоводство.',
            'keywords' => 'биопрепараты для юридических лиц, биоконсерванты, кормовые добавки, микробные удобрения',
        ),
        'inmi-knowledge.php' => array(
            'title' => 'InMi-знания — статьи о биопрепаратах и технологиях применения',
            'description' => 'Экспертные материалы INMI о применении биопрепаратов в растениеводстве, животноводстве, силосовании, очистке воды и бытовых септиках.',
            'keywords' => 'статьи о биопрепаратах, агротехнологии, микробиология, INMI знания',
        ),
        'basket.php' => array(
            'title' => 'Корзина заказа | INMI',
            'description' => 'Проверьте выбранные биопрепараты INMI, количество товаров и оформите заказ через корзину сайта.',
            'robots' => 'noindex,follow',
        ),
        'payment.php' => array(
            'title' => 'Оплата и доставка биопрепаратов INMI',
            'description' => 'Информация об оформлении заказа, способах оплаты и получении биопрепаратов INMI для физических и юридических лиц.',
        ),
        'how-buing.php' => array(
            'title' => 'Как купить биопрепараты INMI — оформление заказа',
            'description' => 'Пошаговая инструкция по выбору, заказу и покупке биопрепаратов INMI на сайте.',
        ),
        'requisites.php' => array(
            'title' => 'Реквизиты INMI — контакты и данные для оплаты',
            'description' => 'Реквизиты, контактная информация и данные для связи с INMI по вопросам заказа биопрепаратов.',
        ),
    );
}

function inmi_get_seo_product_names() {
    return array(
        'antoil-fiz.php' => 'Антойл', 'antoils-fiz.php' => 'Антойл-С', 'bactopin-fiz.php' => 'Бактопин', 'poliect-fiz.php' => 'Полиект', 'maclor-fiz.php' => 'Маклор', 'agromic-fiz.php' => 'АгроМик',
        'risofos-yur.php' => 'Ризофос', 'flebiopin-yur.php' => 'Флебиопин', 'baktopin-yur.php' => 'Бактопин', 'kaksil-ms-yur.php' => 'Лаксил-МС', 'poliekt-yur.php' => 'Полиект', 'bioneit-yur.php' => 'Бионейт', 'baktofish-yur.php' => 'Бактофиш', 'cudamik-yur.php' => 'Цудамик', 'fenoform-yur.php' => 'Феноформ', 'gordebak-yur.php' => 'Гордебак', 'liobakt-yur.php' => 'Лиобакт', 'apifil-yur.php' => 'Апифил', 'biosef-yur.php' => 'Биосеф', 'antoil-org.php' => 'Антойл', 'biotilia-yur.php' => 'Биотилия', 'kaksil-m-yur.php' => 'Лаксил-М', 'poltribak-yur.php' => 'Полтрибак', 'gramisil-yur.php' => 'Грамисил', 'soariz-yur.php' => 'СояРиз', 'maklor-yur.php' => 'Маклор', 'pf-complex.php' => 'ПФ-комплекс', 'cbo-yur.php' => 'СБО', 'rodobel-yur.php' => 'Родобел', 'biolinum-yur.php' => 'Биолинум', 'agromik-yur-page.php' => 'АгроМик', 'biokit-yur.php' => 'Биокит', 'deammon-yur.php' => 'Деаммон', 'antoil-plus-org.php' => 'Антойл Плюс', 'kaksil-ms2-yur.php' => 'Лаксил-МС2', 'rumibakt-yur.php' => 'Румибакт', 'polibakt-yur.php' => 'Полибакт', 'teamin-yur.php' => 'Теамин', 'alfalaktim-yur.php' => 'Альфалактим', 'metalaktim-yur.php' => 'Металактим',
    );
}

function inmi_get_current_seo_meta() {
    $meta = inmi_get_seo_defaults();
    if ( is_singular() && function_exists( 'get_the_title' ) ) {
        $title = wp_strip_all_tags( get_the_title() );
        if ( $title ) {
            $meta['title'] = $title . ' | INMI';
        }
    }
    foreach ( inmi_get_template_seo_map() as $file => $data ) {
        if ( inmi_is_current_template_file( $file ) ) {
            $meta = array_merge( $meta, $data );
            break;
        }
    }
    foreach ( inmi_get_seo_product_names() as $file => $name ) {
        if ( inmi_is_current_template_file( $file ) ) {
            $segment = strpos( $file, '-fiz.php' ) !== false ? 'для физических лиц' : 'для юридических лиц';
            $meta = array_merge( $meta, array(
                'title' => $name . ' — купить биопрепарат ' . $segment . ' | INMI',
                'description' => 'Описание, назначение, форма выпуска и документы на биопрепарат ' . $name . ' INMI. Подберите дозировку и оставьте заявку на поставку.',
                'keywords' => $name . ', биопрепарат ' . $name . ', купить ' . $name . ', INMI',
                'type' => 'product',
            ) );
            break;
        }
    }

    if ( ! empty( $GLOBALS['inmi_custom_title'] ) ) {
        $meta['title'] = $GLOBALS['inmi_custom_title'];
        $meta['type']  = 'article';
    }
    if ( ! empty( $GLOBALS['inmi_custom_description'] ) ) {
        $meta['description'] = $GLOBALS['inmi_custom_description'];
    }
    $meta['canonical'] = wp_get_canonical_url() ?: home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) );
    $meta['image'] = get_the_post_thumbnail_url( null, 'large' ) ?: get_template_directory_uri() . '/assets/img/logo.svg';
    $meta['robots'] = $meta['robots'] ?? 'index,follow,max-snippet:-1,max-image-preview:large,max-video-preview:-1';
    return $meta;
}

function inmi_output_structured_data( $meta ) {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => $meta['type'] === 'product' ? 'Product' : ( $meta['type'] === 'article' ? 'Article' : 'WebPage' ),
        'name' => $meta['title'],
        'description' => $meta['description'],
        'url' => $meta['canonical'],
        'image' => $meta['image'],
        'publisher' => array( '@type' => 'Organization', 'name' => 'INMI', 'url' => home_url( '/' ) ),
    );
    if ( 'Product' === $schema['@type'] ) {
        $schema['brand'] = array( '@type' => 'Brand', 'name' => 'INMI' );
    }
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}

?>
