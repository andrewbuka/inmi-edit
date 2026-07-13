  <?php 
    // template Name: Payment;
?>

<?php get_header(); ?>

<?php
$inmi_info_title = get_the_title();
$inmi_info_intro = '';
$inmi_info_steps = array();
$inmi_info_badges = array();

switch ( basename( get_page_template() ) ) {
	case 'payment.php':
		$inmi_info_intro = 'Безопасная онлайн-оплата заказов с понятной навигацией и быстрым переходом к оформлению.';
		$inmi_info_steps = array( 'Выберите продукцию', 'Оформите заказ', 'Оплатите онлайн' );
		$inmi_info_badges = array( 'Безналичная оплата', 'Корзина на сайте', 'Поддержка специалиста' );
		break;
	case 'how-buing.php':
		$inmi_info_intro = 'Короткая инструкция по выбору биопрепаратов, оформлению корзины и согласованию доставки.';
		$inmi_info_steps = array( 'Подберите препарат', 'Добавьте в корзину', 'Получите подтверждение' );
		$inmi_info_badges = array( 'Для физ. и юр. лиц', 'Консультация', 'Расчёт расхода' );
		break;
	case 'requisites.php':
		$inmi_info_intro = 'Актуальные данные Института микробиологии для договоров, счетов и связи по заказам.';
		$inmi_info_steps = array( 'Проверьте данные', 'Укажите реквизиты', 'Свяжитесь с нами' );
		$inmi_info_badges = array( 'УНП 100289066', 'Минск', 'НАН Беларуси' );
		break;
}
?>

<main class="inmi-info-page">
	<section class="inmi-info-hero">
		<div class="container">
			<div class="inmi-info-hero__grid">
				<div class="inmi-info-hero__content">
					<nav class="inmi-info-breadcrumbs" aria-label="Навигационная цепочка">
						<a href="<?php echo esc_url( get_page_link( 8 ) ); ?>">Главная</a>
						<span aria-hidden="true">/</span>
						<span><?php echo esc_html( $inmi_info_title ); ?></span>
					</nav>
					<p class="inmi-info-kicker">Покупателям INMI</p>
					<h1><?php echo esc_html( $inmi_info_title ); ?></h1>
					<?php if ( $inmi_info_intro ) : ?>
						<p class="inmi-info-lead"><?php echo esc_html( $inmi_info_intro ); ?></p>
					<?php endif; ?>
					<div class="inmi-info-actions">
						<a class="inmi-info-btn inmi-info-btn--primary" href="http://inmi/basket/">Перейти в корзину</a>
						<a class="inmi-info-btn inmi-info-btn--secondary" href="tel:+375447507890">Получить консультацию</a>
					</div>
				</div>
				<div class="inmi-info-hero__panel" aria-label="Ключевые шаги">
					<?php foreach ( $inmi_info_steps as $index => $step ) : ?>
						<div class="inmi-info-step">
							<span><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
							<strong><?php echo esc_html( $step ); ?></strong>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="inmi-info-content">
		<div class="container">
			<div class="inmi-info-layout">
				<article class="inmi-info-card">
					<?php the_content(); ?>
				</article>
				<aside class="inmi-info-aside" aria-label="Полезная информация">
					<h2>Полезно знать</h2>
					<ul>
						<?php foreach ( $inmi_info_badges as $badge ) : ?>
							<li><?php echo esc_html( $badge ); ?></li>
						<?php endforeach; ?>
					</ul>
					<div class="inmi-info-contact">
						<span>Нужна помощь?</span>
						<a href="tel:+375447507890">+375 (44) 750-78-90</a>
						<a href="mailto:inmisale@mail.ru">inmisale@mail.ru</a>
					</div>
				</aside>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
