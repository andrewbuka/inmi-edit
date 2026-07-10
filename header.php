<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<?php $inmi_seo_meta = function_exists( 'inmi_get_current_seo_meta' ) ? inmi_get_current_seo_meta() : array(); ?>
	<title><?php echo esc_html( $inmi_seo_meta['title'] ?? get_bloginfo( 'name' ) ); ?></title>
	<meta name="description" content="<?php echo esc_attr( $inmi_seo_meta['description'] ?? '' ); ?>">
	<?php if ( ! empty( $inmi_seo_meta['keywords'] ) ) : ?>
	<meta name="keywords" content="<?php echo esc_attr( $inmi_seo_meta['keywords'] ); ?>">
	<?php endif; ?>
	<meta name="robots" content="<?php echo esc_attr( $inmi_seo_meta['robots'] ?? 'index,follow' ); ?>">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php if ( ! empty( $inmi_seo_meta['canonical'] ) ) : ?>
	<link rel="canonical" href="<?php echo esc_url( $inmi_seo_meta['canonical'] ); ?>">
	<?php endif; ?>
	<meta property="og:locale" content="ru_RU">
	<meta property="og:type" content="<?php echo esc_attr( $inmi_seo_meta['type'] ?? 'website' ); ?>">
	<meta property="og:title" content="<?php echo esc_attr( $inmi_seo_meta['title'] ?? '' ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $inmi_seo_meta['description'] ?? '' ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $inmi_seo_meta['canonical'] ?? home_url( '/' ) ); ?>">
	<meta property="og:site_name" content="INMI">
	<?php if ( ! empty( $inmi_seo_meta['image'] ) ) : ?>
	<meta property="og:image" content="<?php echo esc_url( $inmi_seo_meta['image'] ); ?>">
	<?php endif; ?>
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo esc_attr( $inmi_seo_meta['title'] ?? '' ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $inmi_seo_meta['description'] ?? '' ); ?>">
	<link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/img/sgr.png' ); ?>">
	<?php wp_head(); ?>
	<?php if ( function_exists( 'inmi_output_structured_data' ) ) { inmi_output_structured_data( $inmi_seo_meta ); } ?>
</head>

<?php
$inmi_current_template = basename( get_page_template() );
$inmi_is_yur_page     = is_page( 'yur-page' ) || 'yur-page.php' === $inmi_current_template;
$inmi_is_main_page    = ( is_front_page() || is_home() || is_page( 8 ) ) && ! $inmi_is_yur_page;
?>
<body id="home" class="inner-scroll">

	<header class="header">
		<a href="#" class="nav-btn">
			<span></span>
			<span></span>
			<span></span>
		</a>
		<div class="top-panel">
			<div class="container">
				<div class="top-panel-cover">
					<ul class="header-cont">
						<li><a href="tel:+375447507890"><i class="fa fa-phone"></i>+375 (44) 750-78-90</a></li>
						<li><a href="mailto:inmisale@mail.ru"><i class="fa fa-envelope" aria-hidden="true"></i>inmisale@mail.ru</a></li>
					</ul>
					<ul class="icon-right-list">
						</a></li>
						<li><a class="header-like header-cart" href="http://inmi/basket"><i class="fa fa-shopping-cart" aria-hidden="true"><span class="count-prod">0</span></i></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="header-menu">
			<div class="container">
				<a href="<?php echo get_page_link(8); ?>" class="logo"><img class="logo-inmi" src="<?php the_field('logo', 8) ?>" alt="logo"></a>
				<nav class="nav-menu">
					<ul class="nav-list">
						<li>
							<a class="<?php echo $inmi_is_main_page ? 'header-nav-active' : ''; ?>" href="<?php echo get_page_link(8); ?>">Главная</a>
						</li>
						<li><a class="<?php echo $inmi_is_main_page ? 'header-nav-active' : ''; ?>" href="<?php echo get_page_link(8); ?>#fiz-prod">физ. лица</a></li>
						<li class="header-yur-nav-item">
							<?php if ( $inmi_is_main_page ) : ?>
								<span class="header-yur-hint" aria-hidden="true">
									<span class="header-yur-hint__text">юр лица здесь</span>
									<svg class="header-yur-hint__arrow" width="64" height="30" viewBox="0 0 64 30" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M4 6C18 2 31 4 42 12C49 17 52 23 58 23" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-dasharray="4 5"/>
										<path d="M52 17L59 23L51 27" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</span>
							<?php endif; ?>
							<a class="<?php echo $inmi_is_yur_page ? 'header-nav-active' : ''; ?>" href="http://inmi/yur-page/"><strong>Препараты для юр. лиц</strong></a>
						</li>
						<li><a href="<?php echo get_page_link(8); ?>#contacts">Контакты</a></li>
						<li><a target="_blank" href="https://mbio.bas-net.by/">Сайт Института</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</header>
	<!-- =============== HEADER END =============== -->
