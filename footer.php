<!--==================== FOOTER ====================-->
	<footer class="site-footer-modern">
		<div class="container">
			<div class="footer-modern-top">
				<div class="footer-modern-brand">
					<a class="footer-modern-logo" href="<?php echo esc_url( get_page_link( 8 ) ); ?>" aria-label="INMI — на главную">
						<img src="<?php echo esc_url( get_field( 'logo', 8 ) ); ?>" alt="INMI">
					</a>
					<p class="footer-modern-kicker">Институт микробиологии НАН Беларуси</p>
					<h2>Биопрепараты для сельского хозяйства, экологии и производства</h2>
					<p>Подберём решение под вашу задачу, рассчитаем расход и поможем оформить заказ для физических и юридических лиц.</p>
					<div class="footer-modern-actions">
						<a class="footer-modern-btn" href="tel:+375447507890">Позвонить</a>
						<a class="footer-modern-link" href="mailto:inmisale@mail.ru">Написать на почту</a>
					</div>
				</div>

				<div class="footer-modern-card footer-modern-contacts">
					<h6>Контакты</h6>
					<ul>
						<li><span>Телефон</span><a href="tel:+375447507890">+375 (44) 750-78-90</a></li>
						<li><span>Email</span><a href="mailto:inmisale@mail.ru">inmisale@mail.ru</a></li>
						<li><span>Адрес</span><p>220084, г. Минск, ул. Академика Купревича, 2</p></li>
					</ul>
				</div>
			</div>

			<div class="footer-modern-grid">
				<div class="footer-modern-card">
					<h6>Навигация</h6>
					<ul class="footer-modern-menu">
						<li><a href="<?php echo esc_url( get_page_link( 8 ) ); ?>">Главная</a></li>
						<li><a href="<?php echo esc_url( get_page_link( 8 ) ); ?>#fiz-prod">Для физ. лиц</a></li>
						<li><a href="http://inmi/yur-page/">Для юр. лиц</a></li>
						<li><a href="<?php echo esc_url( get_page_link( 8 ) ); ?>#contacts">Контакты</a></li>
					</ul>
				</div>

				<div class="footer-modern-card">
					<h6>Покупателям</h6>
					<ul class="footer-modern-menu">
						<li><a href="http://inmi/buying/">Как совершить покупку</a></li>
						<li><a href="http://inmi/payment/">Оплата онлайн</a></li>
						<li><a href="http://inmi/basket/">Корзина</a></li>
						<li><a href="http://inmi/requisites/">Реквизиты</a></li>
					</ul>
				</div>

				<div class="footer-modern-card">
					<h6>Соцсети</h6>
					<ul class="footer-modern-socials">
						<li><a target="_blank" rel="noopener" href="https://invite.viber.com/?g2=AQBraLupPo8rSk2YPoN%2Bzo70k8QbxSBkOzKJG%2BMsZDnRDZS2JDAB2O%2FKSmRkYEkg&lang=ru">Viber</a></li>
						<li><a target="_blank" rel="noopener" href="https://t.me/inmi_by">Telegram</a></li>
						<li><a target="_blank" rel="noopener" href="https://www.tiktok.com/@inmi.by">TikTok</a></li>
						<li><a target="_blank" rel="noopener" href="https://www.youtube.com/channel/UCRaPXjE_UVRXqRUXNbFH-ww">YouTube</a></li>
					</ul>
				</div>
			</div>

			<div class="footer-modern-requisites">
				<strong>ГНУ «Институт микробиологии Национальной академии наук Беларуси»</strong>
				<span>УНП 100289066 · В Едином государственном реестре юридических лиц и индивидуальных предпринимателей за №100289066, 15.08.2000, Мингорисполком.</span>
			</div>

			<div class="footer-modern-bottom">
				<p>&copy; 2026 Институт микробиологии НАН Беларуси. Все права защищены.</p>
				<a href="https://mbio.bas-net.by/" target="_blank" rel="noopener">Сайт Института</a>
			</div>
		</div>
	</footer>
	<!--================== FOOTER END ==================-->

	<!--===================== FLOATING ACTIONS =====================-->
	<div class="floating-actions" aria-label="Быстрые действия">
		<a class="floating-cart header-like header-cart" href="http://inmi/basket" aria-label="Перейти в корзину">
			<i class="fa fa-shopping-cart" aria-hidden="true"><span class="count-prod">0</span></i>
		</a>
		<a class="to-top" href="#home" aria-label="Наверх">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</a>
	</div>
	<!--=================== FLOATING ACTIONS END ===================-->
	<!--==================== SCRIPT	====================-->
	



	<?php get_template_part('template-yur-calculator'); ?>

    <?php wp_footer(); ?>
</body>
</html>
