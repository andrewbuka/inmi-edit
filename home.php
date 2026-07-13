  <?php 
    // template Name: Home;
?>

<?php get_header(); ?>

<!-- =============== main-slider =============== -->
	<section class="s-main-slider">
		<div class="main-slide-navigation"></div>
		<ul class="main-soc-list">
			<li><a target="_blank" href="https://www.tiktok.com/@inmi.by">Tiktok</a></li>
			<li><a target="_blank" href="https://www.youtube.com/@inmi_bioproduct">YouTube</a></li>

			<li><a target="_blank" href="https://invite.viber.com/?g2=AQBraLupPo8rSk2YPoN%2Bzo70k8QbxSBkOzKJG%2BMsZDnRDZS2JDAB2O%2FKSmRkYEkg&lang=ru">Viber</a></li>
			
		</ul>
		<div class="main-slider">
			
			

			<?php
				global $post;
				
				$myposts = get_posts([ 
					'numberposts' => -1,
					'category_name'    => 'slider'
				]);
				
				if( $myposts ){
					foreach( $myposts as $post ){
						setup_postdata( $post );
						
				?>
					<div class="main-slide main-slide-<?php echo esc_attr( sanitize_title( get_the_title() ) ); ?>" style="background-image: url('<?php the_field('slide-back') ?>');background-position: center;
    background-repeat: no-repeat;
    background-size: cover;">
					
						<div class="container">
							<div class="main-slide-info">
								<h2 class="title"><?php the_title(); ?></h2>
								<p><?php the_content(); ?></p>
								<ul class="main-slide-benefits" aria-label="Преимущества биопрепаратов">
									<li>
										<span class="benefit-number">50+</span>
										<span class="benefit-text">лет научных разработок</span>
									</li>
									<li>
										<span class="benefit-number">ЭКО</span>
										<span class="benefit-text">решения для хозяйств</span>
									</li>
									<li>
										<span class="benefit-number">BY</span>
										<span class="benefit-text">производство в Беларуси</span>
									</li>
								</ul>
									<div class="slide-btn more-box"><a href="<?php the_field('slide-link') ?>">Подробнее</a></div>
								<!-- <a href="#" class="btn"><span>buy now</span></a> -->
							</div>
							<div class="slide-img-cover" aria-label="Фото продукта">
								<img src="<?php the_field('slide-img') ?>" alt="Фото продукта <?php echo esc_attr( get_the_title() ); ?>" class="slide-img">
							</div>
						</div>
				</div>
				
			<?php } } wp_reset_postdata(); ?>
			
		</div>
	</section>

	<section class="home-premium-strip" aria-label="Преимущества InMi">
		<div class="container home-premium-strip__grid">
			<div class="home-premium-card">
				<span class="home-premium-card__icon">✓</span>
				<div>
					<strong>Научная экспертиза</strong>
					<p>Препараты разработаны на базе микробиологических исследований и практических испытаний.</p>
				</div>
			</div>
			<div class="home-premium-card">
				<span class="home-premium-card__icon">BY</span>
				<div>
					<strong>Белорусское производство</strong>
					<p>Контролируем качество партий и подбираем решения под реальные задачи хозяйств.</p>
				</div>
			</div>
			<div class="home-premium-card">
				<span class="home-premium-card__icon">i</span>
				<div>
					<strong>Профессиональная консультация</strong>
					<p>Помогаем выбрать препарат, рассчитать расход и оформить заказ без лишних шагов.</p>
				</div>
			</div>
		</div>
	</section>




	<!--================== S-PRODUCTS ==================-->
	<section id="fiz-prod" class="s-products s-products-fiz">
		<div class="container">
			<div class="tab-wrap">
				<div class="products-title-cover fiz-products-title-cover">
					<div>
						<p class="section-kicker">Каталог для дома и хозяйства</p>
						<h2 class="title">Биопрепараты для физических лиц</h2>
						<p class="section-lead">Профессиональные биотехнологические решения с понятным назначением, ценой и быстрым добавлением в корзину.</p>
					</div>
					<ul class="tab-nav product-tabs ">
						<li class="item none" rel="tab1"><span>All</span></li>
						<li class="item none" rel="tab2"><span>Road bike</span></li>
						<li class="item none" rel="tab3"><span>City bike</span></li>
						<li class="item none" rel="tab4"><span>BMX bike</span></li>
					</ul>
				</div>
				<div class="tabs-content">
					<div class="tab tab1">
						<div class="row my-row product-cover fiz-product-cover ">
							<?php
				global $post;
				
				$myposts = get_posts([ 
					'numberposts' => -1,
					'category_name'    => 'fiz-cards'
				]);
				
				if( $myposts ){
					foreach( $myposts as $post ){
						setup_postdata( $post );
				?>
					<div class="prod-container">
								<div class="product-item fiz-product-card" id="<?php the_field('id-prod') ?>">
									<!-- <span class="top-sale">лидер продаж</span> -->
									<div class="product-card-badge">Для физ. лиц</div>
									<button type="button" class="fiz-calc-open product-card-calc-link" aria-label="Открыть калькулятор расхода для <?php echo esc_attr( get_the_title() ); ?>">
										<span class="product-card-calc-link__icon">≈</span>
										<span>Расход</span>
									</button>

									<a href="<?php the_field('fiz-prod-link') ?>" class="product-img fiz-product-img">
										<img class="lazy" src="<?php the_field('card-img') ?>" data-src="<?php the_field('card-img') ?>" alt="product">
									</a>

									<div class="product-item-cover">
										<div class="price-cover">
											<div class="new-price"><?php the_field('price') ?> BYN</div>
											
										</div>


										<h6 class="prod-title fiz-prod-title">
											<a href="<?php the_field('fiz-prod-link') ?>">
												<?php the_title(); ?><br>
											</a>
										</h6>
										<div class="btn btn-buy"><span>Купить</span></div>
										

										<div class="add-to-card-box none">
											<button type="button" class="refresh-prod" aria-label="Вернуться к кнопке Купить">←</button>
											<input min="1" type="number" class="add-to-card-input" value="1">
											<div class="btn-to-card">Добавить в корзину</div>
										</div>

										<div class="fiz-card-service-note">
											<span>Подберём норму и количество под вашу задачу</span>
										</div>
									</div>
									<div class="prod-info my-prod-info">
										<p class="prod-info-label">Назначение</p>
										<ul class="prod-list">
											<li><?php the_content(); ?></li>
										
										</ul>
									</div>
								</div>
							</div>
				
			<?php } } wp_reset_postdata(); ?>
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ S-PRODUCTS END ================-->


	<!--================== S-INMI-KNOWLEDGE ==================-->
	<section id="inmi-knowledge" class="s-inmi-knowledge">
		<div class="container">
			<div class="knowledge-shell">
				<div class="knowledge-head wow fadeInUp lazy" data-wow-duration=".8s" data-wow-delay=".1s">
					<div class="knowledge-head__copy">
						<p class="knowledge-eyebrow">Экспертная библиотека</p>
						<h2 class="title knowledge-title">InMi-знания</h2>
						<p class="knowledge-lead">Практические материалы о микробиологических решениях для растениеводства, животноводства, экологии и промышленной биотехнологии.</p>
					</div>
					<a class="knowledge-all-link" href="/inmi-knowledge/">Все статьи <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
				</div>

				<div class="knowledge-layout">
					<article class="knowledge-hero-card wow fadeInUp lazy" data-wow-duration=".8s" data-wow-delay=".12s">
						<div class="knowledge-hero-card__content">
							<span class="knowledge-card-meta"><i class="fa fa-flask" aria-hidden="true"></i> Подборка InMi</span>
							<h3>Научные ответы на прикладные задачи</h3>
							<p>Собираем в одном разделе короткие прикладные разборы: от запуска септика до обработки семян и сохранения кормов.</p>
							<ul class="knowledge-stats" aria-label="Темы раздела InMi-знания">
								<li><strong>5</strong><span>направлений</span></li>
								<li><strong>∞</strong><span>практики</span></li>
							</ul>
							<a class="knowledge-hero-link" href="/inmi-knowledge/">Перейти в базу знаний <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
						</div>
					</article>

					<div class="knowledge-grid">
						<article class="knowledge-card wow fadeInUp lazy" data-wow-duration=".8s" data-wow-delay=".16s">
							<a class="knowledge-card-link" href="/news-about-septik/" aria-label="Бактерии для септика: как запустить и восстановить работу автономной канализации">
								<span class="knowledge-card-icon"><i class="fa fa-tint" aria-hidden="true"></i></span>
								<span class="knowledge-card-meta">Экология</span>
								<h3>Очистка стоков</h3>
								<p>Бактерии для септика: как запустить и восстановить работу автономной канализации.</p>
								<span class="knowledge-read-more">Читать материал <i class="fa fa-angle-right" aria-hidden="true"></i></span>
							</a>
						</article>

						<article class="knowledge-card wow fadeInUp lazy" data-wow-duration=".8s" data-wow-delay=".2s">
							<a class="knowledge-card-link" href="/news-about-silos/" aria-label="Животноводство и корма">
								<span class="knowledge-card-icon"><i class="fa fa-leaf" aria-hidden="true"></i></span>
								<span class="knowledge-card-meta">Корма</span>
								<h3>Питательность силоса</h3>
								<p>Причины порчи, потери сухого вещества и роль бактериальных заквасок.</p>
								<span class="knowledge-read-more">Читать материал <i class="fa fa-angle-right" aria-hidden="true"></i></span>
							</a>
						</article>

						<article class="knowledge-card wow fadeInUp lazy" data-wow-duration=".8s" data-wow-delay=".24s">
							<a class="knowledge-card-link" href="/news-about-blueberry/" aria-label="Растениеводство">
								<span class="knowledge-card-icon"><i class="fa fa-pagelines" aria-hidden="true"></i></span>
								<span class="knowledge-card-meta">Растениеводство</span>
								<h3>Приживаемость голубики</h3>
								<p>Как помочь саженцам адаптироваться и укрепить корневую систему.</p>
								<span class="knowledge-read-more">Читать материал <i class="fa fa-angle-right" aria-hidden="true"></i></span>
							</a>
						</article>

						<article class="knowledge-card wow fadeInUp lazy" data-wow-duration=".8s" data-wow-delay=".28s">
							<a class="knowledge-card-link" href="/news-about-soa/" aria-label="Инокуляция сои">
								<span class="knowledge-card-icon"><i class="fa fa-circle-o" aria-hidden="true"></i></span>
								<span class="knowledge-card-meta">Соя</span>
								<h3>Эффективные клубеньки</h3>
								<p>Зачем обрабатывать семена и как оценить результат инокуляции.</p>
								<span class="knowledge-read-more">Читать материал <i class="fa fa-angle-right" aria-hidden="true"></i></span>
							</a>
						</article>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ S-INMI-KNOWLEDGE END ================-->

	<!--================== S-CONTACTS ==================-->
	<section id="contacts" class="s-subscribe contacts-section" style="background-image: url(assets/my-img/12.png);">
		<span class="mask"></span>
		<div class="container contacts-container">
			<div class="contacts-panel wow fadeInLeftBlur lazy" data-wow-duration=".8s" data-wow-delay=".1s">
				<div class="contacts-heading">
					<p class="contacts-eyebrow">Связаться с нами</p>
					<h2 class="title contacts-title"><span>Контакты</span></h2>
					<p class="contacts-lead">Подскажем, какой биопрепарат подойдет под вашу задачу, рассчитаем расход и поможем оформить заказ или запрос для сотрудничества.</p>
					<div class="contacts-status" aria-label="Статус консультации">
						<span class="contacts-status__dot" aria-hidden="true"></span>
						<span>Консультация специалиста по подбору биопрепаратов</span>
					</div>
				</div>

				<div class="contacts-list">
					<a class="contact-card contact-card-primary" href="tel:+375447507890">
						<span class="contact-card-icon"><i class="fa fa-phone" aria-hidden="true"></i></span>
						<span class="contact-card-content">
							<span class="contact-card-label">Телефон</span>
							<strong>+375 (44) 750-78-90</strong>
							<small>Позвонить консультанту</small>
						</span>
					</a>

					<a class="contact-card" href="mailto:inmisale@mail.ru">
						<span class="contact-card-icon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
						<span class="contact-card-content">
							<span class="contact-card-label">Email</span>
							<strong>inmisale@mail.ru</strong>
							<small>Для заказов и консультаций</small>
						</span>
					</a>

					<div class="contact-card">
						<span class="contact-card-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
						<div class="contact-card-content">
							<span class="contact-card-label">Адрес</span>
							<strong>г. Минск, ул. Академика Купревича, 2</strong>
							<small>Институт микробиологии НАН Беларуси</small>
						</div>
					</div>
				</div>

				<div class="contacts-actions" aria-label="Быстрые действия">
					<a class="contacts-action contacts-action-primary" href="tel:+375447507890">Позвонить</a>
					<a class="contacts-action" href="mailto:inmisale@mail.ru">Написать на email</a>
				</div>

				<div class="contacts-schedule">
					<span class="contact-card-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
					<div>
						<span class="contact-card-label">График работы</span>
						<ul class="contacts-schedule-list">
							<li><span>Пн-Чт</span><strong>9:00 - 18:00</strong></li>
							<li><span>Пт</span><strong>9:00 - 15:55</strong></li>
							<li><span>Обед</span><strong>13:00 - 13:35</strong></li>
						</ul>
						<p>Суббота и воскресенье — выходные.</p>
					</div>
				</div>
			</div>

			<div class="contacts-map wow fadeInRightBlur lazy" data-wow-duration=".8s" data-wow-delay=".2s">
				<div class="contacts-map-top">
					<div>
						<span class="contact-card-label">Мы на карте</span>
						<p>Институт микробиологии НАН Беларуси</p>
					</div>
					<a class="contacts-map-link" href="https://www.google.com/maps/search/?api=1&query=%D0%B3.+%D0%9C%D0%B8%D0%BD%D1%81%D0%BA,+%D1%83%D0%BB.+%D0%90%D0%BA%D0%B0%D0%B4%D0%B5%D0%BC%D0%B8%D0%BA%D0%B0+%D0%9A%D1%83%D0%BF%D1%80%D0%B5%D0%B2%D0%B8%D1%87%D0%B0,+2" target="_blank" rel="noopener">Открыть маршрут</a>
				</div>
				<div class="contacts-map-badge" aria-label="Адрес офиса">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
					<span>Минск, ул. Академика Купревича, 2</span>
				</div>
				<div class="contacts-map-frame">
					<iframe title="Институт микробиологии НАН Беларуси на карте" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d18794.367081731318!2d27.683449!3d53.926487!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dbcebb4d6f6d2b%3A0x1c24ca875beb668c!2z0JjQvdGB0YLQuNGC0YPRgiDQvNC40LrRgNC-0LHQuNC-0LvQvtCz0LjQuCDQndCQ0J0g0JHQtdC70LDRgNGD0YHQuA!5e0!3m2!1sru!2sby!4v1737573509389!5m2!1sru!2sby" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
		</div>
	</section>
	<!--================ S-CONTACTS END ================-->
	


	

	




	<!--=================== S-CLIENTS ===================-->
	<section class="s-clients">
		<div class="container">
			<div class="clients-cover">
				<div class="client-slide">
					<div class="client-slide-cover">
						<img src="http://inmi/wp-content/uploads/2026/05/ipay.png" alt="img">
					</div>
				</div>
				<div class="client-slide">
					<div class="client-slide-cover">
						<img src="http://inmi/wp-content/uploads/2026/05/erip.png" alt="img">
					</div>
				</div>
				<div class="client-slide">
					<div class="client-slide-cover">
						<img src="http://inmi/wp-content/uploads/2026/05/gmo.png">
					</div>
				</div>
				<div class="client-slide">
					<div class="client-slide-cover">
						<img src="http://inmi/wp-content/uploads/2026/05/iso.png" alt="img">
					</div>
				</div>
				<div class="client-slide">
					<div class="client-slide-cover">
						<img src="http://inmi/wp-content/uploads/2026/05/tp.png" alt="img">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================= S-CLIENTS END =================-->

	 <?php get_footer(); ?>