<?php
/**
 * Shared расход calculator for legal entity product cards and product pages.
 */
?>
	<div class="yur-calc-overlay" data-yur-calc-close></div>
	<aside class="yur-calc-panel" aria-hidden="true" aria-labelledby="yur-calc-title" role="dialog">
		<div class="yur-calc-panel__header">
			<div class="yur-calc-panel__header-content">
				<p class="yur-calc-panel__eyebrow">InMi-калькулятор</p>
				<h3 id="yur-calc-title" class="yur-calc-panel__title">Калькулятор расхода препарата</h3>
				<p class="yur-calc-panel__subtitle">Для более точного расчета и консультаций звоните или пишите</p>
			</div>
			<button class="yur-calc-panel__close" type="button" aria-label="Закрыть калькулятор" data-yur-calc-close>&times;</button>
		</div>
		<div class="yur-calc-panel__body">
			<div class="yur-calc-panel__benefits" aria-label="Преимущества калькулятора">
				<span><b>01</b> Выберите параметры</span>
				<span><b>02</b> Узнайте расход</span>
			</div>
			<p class="yur-calc-panel__lead">Заполните параметры применения — калькулятор рассчитает ориентировочную потребность в препарате по выбранной культуре, объекту или способу внесения.</p>
			<div class="yur-calc-fields" aria-label="Поля для расчета расхода препарата">
				<label class="yur-calc-field">
					<span>Объем обработки</span>
					<input type="number" min="0" step="0.01" placeholder="Например, 120">
				</label>
				<label class="yur-calc-field">
					<span>Единица измерения</span>
					<select>
						<option>тонн</option>
						<option>м³</option>
						<option>га</option>
						<option>голов</option>
					</select>
				</label>
				<label class="yur-calc-field yur-calc-field--wide">
					<span>Комментарий к задаче</span>
					<textarea rows="4" placeholder="Опишите условия применения препарата"></textarea>
				</label>
			</div>
			<button class="btn btn-form yur-calc-panel__submit" type="button"><span>Рассчитать</span></button>
			<div class="yur-calc-result" aria-live="polite" hidden></div>
		</div>
	</aside>

	<style>
		.yur-calc-overlay {
			position: fixed;
			inset: 0;
			background: rgba(13, 22, 36, .62);
			backdrop-filter: blur(7px);
			opacity: 0;
			visibility: hidden;
			transition: opacity .28s ease, visibility .28s ease;
			z-index: 998;
		}

		.yur-calc-overlay.is-active {
			opacity: 1;
			visibility: visible;
		}

		.yur-calc-panel {
			position: fixed;
			top: 0;
			right: 0;
			width: min(560px, 100%);
			height: 100vh;
			padding: 0;
			overflow-y: auto;
			background: linear-gradient(180deg, #f8fafc 0%, #eef3f8 100%);
			box-shadow: -30px 0 90px rgba(16, 28, 46, .32);
			transform: translateX(105%);
			transition: transform .38s cubic-bezier(.22, 1, .36, 1);
			z-index: 999;
		}

		.yur-calc-panel::before {
			content: "";
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 7px;
			background: linear-gradient(90deg, #ffd910 0%, #ffe769 42%, #202b40 100%);
		}

		.yur-calc-panel.is-active {
			transform: translateX(0);
		}

		.yur-calc-panel__header {
			position: relative;
			display: flex;
			align-items: flex-start;
			justify-content: space-between;
			gap: 20px;
			padding: 44px 38px 34px;
			overflow: hidden;
			background: radial-gradient(circle at 86% 18%, rgba(255, 217, 16, .28), transparent 30%), linear-gradient(135deg, #202b40 0%, #31445f 100%);
			color: #fff;
		}

		.yur-calc-panel__header::after {
			content: "";
			position: absolute;
			right: -80px;
			bottom: -125px;
			width: 250px;
			height: 250px;
			border: 38px solid rgba(255, 255, 255, .08);
			border-radius: 50%;
		}

		.yur-calc-panel__header-content,
		.yur-calc-panel__close {
			position: relative;
			z-index: 1;
		}

		.yur-calc-panel__eyebrow {
			display: inline-flex;
			margin: 0 0 14px;
			padding: 8px 13px;
			border-radius: 999px;
			background: rgba(255, 217, 16, .16);
			color: #ffd910;
			font-size: 12px;
			font-weight: 800;
			letter-spacing: .12em;
			text-transform: uppercase;
		}

		.yur-calc-panel__title {
			max-width: 390px;
			margin: 0;
			color: #fff;
			font-size: clamp(28px, 4vw, 38px);
			line-height: 1.08;
			font-weight: 800;
		}

		.yur-calc-panel__subtitle {
			max-width: 390px;
			margin: 14px 0 0;
			color: rgba(255, 255, 255, .78);
			font-size: 15px;
			line-height: 1.55;
		}

		.yur-calc-panel__close {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 44px;
			height: 44px;
			min-width: 44px;
			border: 1px solid rgba(255, 255, 255, .22);
			border-radius: 50%;
			background: rgba(255, 255, 255, .1);
			color: #fff;
			font-size: 30px;
			line-height: 1;
			cursor: pointer;
			backdrop-filter: blur(8px);
			transition: background .2s ease, color .2s ease, transform .2s ease;
		}

		.yur-calc-panel__close:hover {
			background: #ffd910;
			color: #202b40;
			transform: rotate(90deg);
		}

		.yur-calc-panel__body {
			padding: 28px 38px 38px;
		}

		.yur-calc-panel__benefits {
			display: grid;
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 12px;
			margin-bottom: 20px;
		}

		.yur-calc-panel__benefits span {
			display: flex;
			align-items: center;
			gap: 10px;
			padding: 13px 14px;
			border: 1px solid rgba(30, 44, 70, .08);
			border-radius: 16px;
			background: rgba(255, 255, 255, .86);
			box-shadow: 0 16px 34px rgba(20, 35, 70, .07);
			color: #202b40;
			font-weight: 800;
			font-size: 13px;
		}

		.yur-calc-panel__benefits b {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 30px;
			height: 30px;
			flex: 0 0 30px;
			border-radius: 50%;
			background: #ffd910;
			color: #202b40;
			font-weight: 900;
		}

		.yur-calc-panel__lead {
			margin: 0 0 24px;
			color: #66748a;
			line-height: 1.65;
		}

		.yur-calc-fields {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 16px;
			margin-bottom: 24px;
			padding: 22px;
			border: 1px solid rgba(30, 44, 70, .08);
			border-radius: 24px;
			background: rgba(255, 255, 255, .92);
			box-shadow: 0 22px 55px rgba(20, 35, 70, .09);
		}

		.yur-calc-field {
			display: flex;
			flex-direction: column;
			gap: 9px;
			margin: 0;
			color: #202b40;
			font-weight: 800;
		}

		.yur-calc-question {
			margin: 0;
			color: #202b40;
			font-size: 16px;
			font-weight: 800;
		}

		.yur-calc-choice-list {
			display: grid;
			gap: 10px;
		}

		.yur-calc-choice {
			display: flex;
			gap: 12px;
			padding: 14px 15px;
			border: 1px solid #e3e8f0;
			border-radius: 16px;
			background: #f8fafc;
			color: #202b40;
			cursor: pointer;
			box-shadow: 0 10px 24px rgba(20, 35, 70, .04);
			transition: border-color .2s ease, background .2s ease, box-shadow .2s ease, transform .2s ease;
		}

		.yur-calc-choice:hover {
			transform: translateY(-1px);
			border-color: rgba(255, 217, 16, .85);
			box-shadow: 0 16px 34px rgba(20, 35, 70, .08);
		}

		.yur-calc-choice:has(input:checked) {
			border-color: #ffd910;
			background: linear-gradient(135deg, rgba(255, 217, 16, .18), #fff 62%);
		}

		.yur-calc-choice input {
			flex: 0 0 auto;
			width: auto;
			min-width: 0;
			margin-top: 3px;
			accent-color: #ffd910;
		}

		.yur-calc-choice span {
			flex: 1 1 auto;
		}

		.yur-calc-message {
			grid-column: 1/-1;
			margin: 0;
			color: #66748a;
			line-height: 1.5;
		}

		.yur-calc-field--wide {
			grid-column: 1/-1;
		}

		.yur-calc-field input,
		.yur-calc-field select,
		.yur-calc-field textarea {
			border: 1px solid #dbe2ec;
			border-radius: 16px;
			background: #f8fafc;
			color: #202b40;
			padding: 14px 15px;
			font: inherit;
			outline: none;
			transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
		}

		.yur-calc-field input:focus,
		.yur-calc-field select:focus,
		.yur-calc-field textarea:focus {
			border-color: #ffd910;
			background: #fff;
			box-shadow: 0 0 0 4px rgba(255, 217, 16, .18);
		}

		.yur-calc-panel__submit {
			display: flex;
			align-items: center;
			justify-content: center;
			width: 100%;
			min-height: 58px;
			border: 0;
			border-radius: 16px;
			background: #ffd910;
			color: #202b40;
			box-shadow: 0 18px 38px rgba(255, 217, 16, .28);
			font-weight: 900;
			letter-spacing: .02em;
		}

		.yur-calc-panel__submit:hover {
			background: #202b40;
			color: #fff;
			box-shadow: 0 18px 42px rgba(32, 43, 64, .22);
		}

		.yur-calc-result {
			margin-top: 18px;
			padding: 18px 20px;
			border: 1px solid rgba(255, 217, 16, .42);
			border-radius: 18px;
			background: linear-gradient(135deg, rgba(255, 217, 16, .2), #fff 72%);
			color: #202b40;
			box-shadow: 0 16px 34px rgba(20, 35, 70, .07);
			font-weight: 800;
			line-height: 1.5;
		}

		.yur-calc-result.is-error {
			background: #fff6f1;
			border-color: rgba(217, 48, 37, .24);
			color: #9b3a1f;
		}

		.yur-calc-open {
			cursor: pointer;
		}

		@media (max-width: 575px) {
			.yur-calc-panel__header {
				padding: 36px 22px 28px;
			}

			.yur-calc-panel__body {
				padding: 22px;
			}

			.yur-calc-panel__benefits,
			.yur-calc-fields {
				grid-template-columns: 1fr;
			}

			.yur-calc-fields {
				padding: 16px;
			}
		}
	</style>

	<script type="module">
		import { productsForCalc } from "<?php echo get_template_directory_uri(); ?>/assets/js/data/productsForCalc.js";

		document.addEventListener('DOMContentLoaded', function () {
			var panel = document.querySelector('.yur-calc-panel');
			var overlay = document.querySelector('.yur-calc-overlay');
			var title = document.getElementById('yur-calc-title');
			var closeElements = document.querySelectorAll('[data-yur-calc-close]');
			var calcFields = document.querySelector('.yur-calc-fields');
			var submitButton = document.querySelector('.yur-calc-panel__submit');
			var resultBlock = document.querySelector('.yur-calc-result');
			var activeCalcProduct = null;
			var activeProductName = '';

			if (!panel || !overlay || !title || !calcFields || !submitButton || !resultBlock) {
				return;
			}


			function resetCalcResult() {
				resultBlock.hidden = true;
				resultBlock.classList.remove('is-error');
				resultBlock.textContent = '';
			}

			function showCalcResult(message, isError) {
				resultBlock.hidden = false;
				resultBlock.classList.toggle('is-error', Boolean(isError));
				resultBlock.textContent = message;
			}

			function formatCalcNumber(value) {
				return Number(value.toFixed(2)).toLocaleString('ru-RU', {
					maximumFractionDigits: 2
				});
			}

			function getSelectedCalcCategoryKey() {
				var selectedCategory = calcFields.querySelector('input[name="yur-calc-category"]:checked');
				return selectedCategory ? selectedCategory.value : '';
			}

			function getCalcRule(categoryKey) {
				var rules = {
					cathegorie1: { numerator: 'const1', denominator: 'const2', unit: 'constOne' },
					cathegorie2: { numerator: 'const3', denominator: 'const4', unit: 'constThree' },
					cathegorie3: { numerator: 'const5', denominator: 'const6', unit: 'constFife' },
					cathegorie4: { numerator: 'const7', denominator: 'const8', unit: 'constSeven' },
					cathegorie5: { numerator: 'const9', denominator: 'const10', unit: 'constNine' },
					cathegorie6: { numerator: 'const11', denominator: 'const12', unit: 'constEleven' }
				};

				return rules[categoryKey];
			}

			function calculateProductAmount() {
				if (!activeCalcProduct) {
					showCalcResult('Для выбранного препарата данные калькулятора не найдены.', true);
					return;
				}

				var categoryKey = getSelectedCalcCategoryKey();
				var calcInput = calcFields.querySelector('[data-calc-input]');
				var rule = getCalcRule(categoryKey);

				if (!categoryKey || !rule || !calcInput) {
					showCalcResult('Выберите объект и способ внесения для расчета.', true);
					return;
				}

				var inputValue = parseFloat(String(calcInput.value).replace(',', '.'));
				var numerator = Number(activeCalcProduct[rule.numerator]);
				var denominator = Number(activeCalcProduct[rule.denominator]);
				var unit = activeCalcProduct[rule.unit];

				if (!Number.isFinite(inputValue) || inputValue <= 0) {
					showCalcResult('Введите значение больше нуля для расчета.', true);
					return;
				}

				if (!Number.isFinite(numerator) || !Number.isFinite(denominator) || denominator === 0 || !unit) {
					showCalcResult('Для выбранного способа внесения не настроены данные расчета.', true);
					return;
				}

				var result = (numerator * inputValue) / denominator;
				showCalcResult('Вам необходимо ' + formatCalcNumber(result) + ' ' + unit + ' препарата "' + activeProductName + '"', false);
			}

			function stripCalcTitleClarification(value) {
				return String(value || '').replace(/\s*\([^)]*\)\s*/g, '').trim();
			}

			function normalizeCalcTitle(value) {
				return String(value || '').trim().toLowerCase();
			}

			function getCalcProduct(productName) {
				var titleAliases = {
					'маклор': 'Маклор',
					'антойл': 'Антойл+',
					'антойлс': 'Антойл+'
				};
				var normalizedName = normalizeCalcTitle(productName).replace(/ё/g, 'е').replace(/[^а-яa-z0-9+]/gi, '');
				if (titleAliases[normalizedName]) {
					productName = titleAliases[normalizedName];
				}
				normalizedName = normalizeCalcTitle(productName);
				var exactProduct = productsForCalc.find(function (product) {
					return normalizeCalcTitle(product.title) === normalizedName;
				});

				if (exactProduct) {
					return exactProduct;
				}

				return productsForCalc.find(function (product) {
					return normalizeCalcTitle(stripCalcTitleClarification(product.title)) === normalizedName;
				});
			}

			function createOption(name, value, text, checked) {
				var optionId = name + '-' + value;
				var label = document.createElement('label');
				label.className = 'yur-calc-choice';

				var input = document.createElement('input');
				input.type = 'radio';
				input.name = name;
				input.value = value;
				input.id = optionId;
				input.checked = Boolean(checked);

				var span = document.createElement('span');
				span.textContent = text;

				label.append(input, span);
				return label;
			}

			function createQuestionBlock(title, options, name) {
				var block = document.createElement('div');
				block.className = 'yur-calc-field yur-calc-field--wide yur-calc-choice-block';

				var heading = document.createElement('p');
				heading.className = 'yur-calc-question';
				heading.textContent = title;

				var list = document.createElement('div');
				list.className = 'yur-calc-choice-list';
				options.forEach(function (option, index) {
					list.append(createOption(name, option.key, option.label, index === 0));
				});

				block.append(heading, list);
				return block;
			}

			function getTypeOptions(product) {
				return ['type1', 'type2', 'type3']
					.filter(function (key) { return product[key]; })
					.map(function (key) { return { key: key, label: product[key] }; });
			}

			function getCategoryOptions(product, typeKey) {
				var categoriesByType = {
					type1: ['cathegorie1', 'cathegorie2'],
					type2: ['cathegorie3', 'cathegorie4'],
					type3: ['cathegorie5', 'cathegorie6']
				};

				return (categoriesByType[typeKey] || [])
					.filter(function (key) { return product[key]; })
					.map(function (key) {
						return {
							key: key,
							label: product[key],
							questionKey: 'question' + key.replace('cathegorie', '')
						};
					});
			}

			function renderCalcInput(product, categoryOption) {
				var inputHolder = calcFields.querySelector('[data-calc-input-holder]');
				inputHolder.innerHTML = '';

				if (!categoryOption || !product[categoryOption.questionKey]) {
					return;
				}

				var label = document.createElement('label');
				label.className = 'yur-calc-field yur-calc-field--wide';

				var span = document.createElement('span');
				span.textContent = product[categoryOption.questionKey];

				var input = document.createElement('input');
				input.type = 'number';
				input.min = '0';
				input.step = '0.01';
				input.placeholder = 'Введите значение';
				input.setAttribute('data-calc-input', '');
				input.addEventListener('input', resetCalcResult);

				label.append(span, input);
				inputHolder.append(label);
			}

			function renderCategoryBlock(product, selectedType) {
				var categoryHolder = calcFields.querySelector('[data-category-holder]');
				categoryHolder.innerHTML = '';
				var categoryOptions = getCategoryOptions(product, selectedType);

				if (!categoryOptions.length) {
					renderCalcInput(product, null);
					return;
				}

				categoryHolder.append(createQuestionBlock(product.cathegorie1Title, categoryOptions, 'yur-calc-category'));
				renderCalcInput(product, categoryOptions[0]);

				categoryHolder.querySelectorAll('input[name="yur-calc-category"]').forEach(function (input) {
					input.addEventListener('change', function () {
						var selectedCategory = categoryOptions.find(function (option) { return option.key === input.value; });
						renderCalcInput(product, selectedCategory);
						resetCalcResult();
					});
				});
			}

			function renderCalculatorFields(product) {
				calcFields.innerHTML = '';
				resetCalcResult();

				if (!product) {
					calcFields.innerHTML = '<p class="yur-calc-message">Для выбранного препарата данные калькулятора не найдены.</p>';
					return;
				}

				var typeOptions = getTypeOptions(product);
				var categoryHolder = document.createElement('div');
				categoryHolder.className = 'yur-calc-dynamic-holder yur-calc-field--wide';
				categoryHolder.setAttribute('data-category-holder', '');

				var inputHolder = document.createElement('div');
				inputHolder.className = 'yur-calc-dynamic-holder yur-calc-field--wide';
				inputHolder.setAttribute('data-calc-input-holder', '');

				if (!typeOptions.length) {
					calcFields.innerHTML = '<p class="yur-calc-message">Для выбранного препарата не настроены варианты применения.</p>';
					return;
				}

				calcFields.append(createQuestionBlock(product.type1Title, typeOptions, 'yur-calc-type'), categoryHolder, inputHolder);
				renderCategoryBlock(product, typeOptions[0].key);

				calcFields.querySelectorAll('input[name="yur-calc-type"]').forEach(function (input) {
					input.addEventListener('change', function () {
						renderCategoryBlock(product, input.value);
						resetCalcResult();
					});
				});
			}

			function openCalculator(productName) {
				var calcProduct = getCalcProduct(productName);
				activeCalcProduct = calcProduct;
				activeProductName = productName;
				title.textContent = 'Калькулятор расхода препарата ' + productName;
				renderCalculatorFields(calcProduct);
				panel.classList.add('is-active');
				overlay.classList.add('is-active');
				panel.setAttribute('aria-hidden', 'false');
				document.body.style.overflow = 'hidden';
			}

			function closeCalculator() {
				panel.classList.remove('is-active');
				overlay.classList.remove('is-active');
				panel.setAttribute('aria-hidden', 'true');
				document.body.style.overflow = '';
			}

			submitButton.addEventListener('click', calculateProductAmount);

			document.querySelectorAll('.prod-yur-calc-box .btn, .fiz-calc-box .btn, .fiz-calc-open').forEach(function (button) {
				button.classList.add('yur-calc-open');
				button.setAttribute('type', 'button');
				button.addEventListener('click', function (event) {
					event.preventDefault();
					var card = button.closest('.prod-yur-item, .fiz-product-card, .single-fiz-product');
					var productTitle = card ? card.querySelector('.prod-yur-descr-box h5, .fiz-prod-title a, .my-title') : null;
					var pageTitle = document.querySelector('.my-title, .s-header-title h1, h1');
					var resolvedTitle = productTitle || pageTitle;
					openCalculator(resolvedTitle ? resolvedTitle.textContent.trim() : '');
				});
			});

			closeElements.forEach(function (element) {
				element.addEventListener('click', closeCalculator);
			});

			document.addEventListener('keydown', function (event) {
				if (event.key === 'Escape') {
					closeCalculator();
				}
			});
		});
	</script>

