<x-layout>
	<link rel="stylesheet" href="/css/styles.css">
	<style>
		input[type="date"],
		input[type="time"] {
			border: 1px solid black;
			border-radius: 4px;
			padding: 1px;
			outline: none;

		}

		input[type="date"] {
			margin-bottom: 10px;
		}

		input[type="date"]:focus,
		input[type="time"]:focus {
			border-color: #000000;
			/* Черная обводка при фокусе */
			box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
		}

		/* Стили для ползунков и их значений */
		.slider-container {
			margin-bottom: 20px;
		}

		.slider-container label {
			display: block;
			margin-bottom: 5px;
		}

		.slider-value {
			font-weight: bold;
			margin-left: 10px;
		}

		/* Стили для черного ползунка */
		input[type="range"] {
			-webkit-appearance: none;
			width: 100%;
			height: 8px;
			background: black;
			/* Цвет фона ползунка */
			border-radius: 5px;
			outline: none;
		}

		input[type="range"]::-webkit-slider-thumb {
			-webkit-appearance: none;
			appearance: none;
			width: 20px;
			height: 20px;
			background: black;
			/* Цвет самого бегунка */
			cursor: pointer;
			border-radius: 50%;
		}

		input[type="range"]::-moz-range-thumb {
			width: 20px;
			height: 20px;
			background: black;
			/* Цвет самого бегунка */
			cursor: pointer;
			border-radius: 50%;
		}

		.checkbox-label {
			cursor: pointer;
		}

		.cd-main-content {
			background-color: #fff;
		}
	</style>

	<main class="cd-main-content" style="margin-top: 120px;">
		<div class="cd-tab-filter-wrapper">
			<div class="cd-tab-filter">
				<ul class="cd-filters">
					<li class="placeholder">
						<a data-type="all" href="#0">Все</a> <!-- selected option on mobile -->
					</li>
					<li class="filter"><a class="selected" href="#0" data-type="all">Все</a></li>
					<li class="filter" data-filter=".color-1"><a href="#0" data-type="color-1">По возрастанию цены</a></li>
					<li class="filter" data-filter=".color-2"><a href="#0" data-type="color-2">По убыванию цены</a></li>
				</ul> <!-- cd-filters -->
			</div> <!-- cd-tab-filter -->
		</div> <!-- cd-tab-filter-wrapper -->

		<section class="cd-gallery">
			@forelse($halls as $hall)
			<div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
				<div class="inner-box">
					<div class="image-box">
						<figure class="image"><a href="/hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}"><img src="/storage/photo_halls/{{$hall->preview_hall}}" alt="{{$hall->preview_hall}}" title="{{$hall->name_hall}}"></a></figure>
					</div>
					<div class="lower-box">
						<h4>{{$hall->name_hall}}</h4>
						<div class="pricing clearfix">
							<div class="price">Площадь <span>{{$hall->area_hall}}</span></div>
							<div class="rating">
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
						</div>

						<div class="text text-truncate">{{$hall->description_hall}}
						</div>
						<div class="link-box"><a href="/hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}" class="theme-btn btn-style-three"><span class="btn-title">Просмотреть</span></a></div>
					</div>
				</div>
			</div>
			@empty
			@endforelse
		</section> <!-- cd-gallery -->

		<div class="cd-filter">
			<form>
				<div class="cd-filter-block">
					<h4>Поиск</h4>
					<div class="cd-filter-content">
						<input class="search" type="search" placeholder="Напишите зал или студию">
					</div> <!-- cd-filter-content -->
				</div> <!-- cd-filter-block -->

				<div class="cd-filter-block">
					<h4>Дата и время</h4>
					<div class="cd-filter-content">
						<label for="date">Дата:</label>
						<input class="date" type="date" id="date" name="date">
					</div> <!-- cd-filter-content -->
					<div class="cd-filter-content">
						<label for="time">Время:</label>
						<input class="time" type="time" id="time" name="time" step="1800" list="time-list">
						<datalist id="time-list">
							<option value="08:00">
							<option value="08:30">
							<option value="09:00">
							<option value="09:30">
							<option value="10:00">
							<option value="10:30">
							<option value="11:00">
							<option value="11:30">
							<option value="12:00">
							<option value="12:30">
							<option value="13:00">
							<option value="13:30">
							<option value="14:00">
							<option value="14:30">
							<option value="15:00">
							<option value="15:30">
							<option value="16:00">
							<option value="16:30">
							<option value="17:00">
							<option value="17:30">
							<option value="18:00">
							<option value="18:30">
							<option value="19:00">
							<option value="19:30">
							<option value="20:00">
							<option value="20:30">
							<option value="21:00">
							<option value="21:30">
							<option value="22:00">
						</datalist>
					</div> <!-- cd-filter-content -->
				</div> <!-- cd-filter-block -->

				<div class="cd-filter-block">
					<h4>Цена</h4>
					<div class="cd-filter-content slider-container">
						<label for="price">Максимальная цена (руб):</label>
						<input type="range" id="price" name="price" min="0" max="10000" step="100" value="1000" oninput="document.getElementById('price-value').textContent = this.value;">
						<span id="price-value" class="slider-value">1000</span> <!-- Вывод текущего значения -->
					</div> <!-- cd-filter-content -->
				</div> <!-- cd-filter-block -->

				<div class="cd-filter-block">
					<h4>Площадь</h4>
					<div class="cd-filter-content slider-container">
						<label for="area">Минимальная площадь (м²):</label>
						<input type="range" id="area" name="area" min="0" max="150" step="10" value="20" oninput="document.getElementById('area-value').textContent = this.value;">
						<span id="area-value" class="slider-value">20</span> <!-- Вывод текущего значения -->
					</div> <!-- cd-filter-content -->
				</div> <!-- cd-filter-block -->

				<div class="cd-filter-block">
					<h4>Удобства</h4>
					<ul class="cd-filter-content cd-filters list">
						<li>
							<input class="filter" data-filter=".check1" type="checkbox" id="checkbox1">
							<label class="checkbox-label" for="checkbox1">Колонка</label>
						</li>
						<li>
							<input class="filter" data-filter=".check2" type="checkbox" id="checkbox2">
							<label class="checkbox-label" for="checkbox2">WI-FI</label>
						</li>
						<li>
							<input class="filter" data-filter=".check3" type="checkbox" id="checkbox3">
							<label class="checkbox-label" for="checkbox3">Зеркало</label>
						</li>
						<li>
							<input class="filter" data-filter=".check4" type="checkbox" id="checkbox4">
							<label class="checkbox-label" for="checkbox4">Кондиционер</label>
						</li>
						<li>
							<input class="filter" data-filter=".check5" type="checkbox" id="checkbox5">
							<label class="checkbox-label" for="checkbox5">Парковка на территории</label>
						</li>
					</ul> <!-- cd-filter-content -->
				</div> <!-- cd-filter-block -->

				<div class="cd-filter-block">
					<h4>Студии</h4>
					<div class="cd-filter-content">
						<div class="cd-select cd-filters">
							<select class="filter" name="selectThis" id="selectThis">
								<option value="">Выберите студию</option>
								<option value=".option1">Main</option>
								<option value=".option2">Option 2</option>
								<option value=".option3">Option 3</option>
								<option value=".option4">Option 4</option>
							</select>
						</div> <!-- cd-select -->
					</div> <!-- cd-filter-content -->
				</div> <!-- cd-filter-block -->
			</form>


			<a href="#0" class="cd-close">Закрыть</a>
		</div> <!-- cd-filter -->

		<a href="#0" class="cd-filter-trigger">Фильтр</a>
	</main> <!-- cd-main-content -->

</x-layout>