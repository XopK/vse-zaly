<x-layout>
    <link rel="stylesheet" href="/css/styles.css"> <!-- Resource style -->
    <script src="/js/modernizr.js"></script> <!-- Modernizr -->
    <main class="cd-main-content" style="margin-top: 120px">
        <div class="cd-tab-filter-wrapper">
            <div class="cd-tab-filter">
                <ul class="cd-filters">
                    <li class="placeholder">
                        <a data-type="all" href="#0">Все</a> <!-- selected option on mobile -->
                    </li>
                    <li class="filter"><a class="selected" href="#0" data-type="all">Все</a></li>
                    <li class="filter" data-filter="#color-1"><a href="#0" data-type="color-1">По возрастанию ₽</a></li>
                    <li class="filter" data-filter="#color-2"><a href="#0" data-type="color-2">По убыванию ₽</a></li>
                </ul> <!-- cd-filters -->
            </div> <!-- cd-tab-filter -->
        </div> <!-- cd-tab-filter-wrapper -->

        <section class="cd-gallery" id="halls-container">
            @forelse($halls as $hall)
                <div class="room-block-two fix-block col-lg-4 col-md-6 col-sm-12 hall-item"
                     data-id="{{ $hall->id }}"
                     data-price="{{ $hall->max_price }}"
                     data-area="{{ $hall->area_hall }}"
                     data-name="{{ Str::lower($hall->name_hall) }}"
                     data-studio="{{ Str::slug($hall->studio->name_studio) }}">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="/hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}"><img
                                            src="/storage/photo_halls/{{$hall->preview_hall}}"
                                            alt="{{$hall->preview_hall}}"
                                            title="{{$hall->name_hall}}"></a>
                            </figure>
                        </div>
                        <div class="lower-box">
                            <h4>{{$hall->name_hall}}</h4>
                            <div class="pricing clearfix">
                                <div class="price">Площадь <span>{{$hall->area_hall}} м²</span></div>
                            </div>
                            <div class="text text-truncate">{{$hall->description_hall}}</div>
                            <div class="link-box"><a href="/hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}"
                                                     class="theme-btn btn-style-three"><span
                                            class="btn-title">Просмотреть</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="cd-fail-message">No results found</div>
            @endforelse
        </section>
        <!-- cd-gallery -->

        <div class="cd-filter">
            <form>
                <div class="cd-filter-block">
                    <h5>Поиск</h5>

                    <div class="cd-filter-content">
                        <input type="search" name="search" placeholder="Напишите зал или студию">
                    </div> <!-- cd-filter-content -->
                </div> <!-- cd-filter-block -->


                <div class="cd-filter-block">
                    <h5>Дата и время</h5>
                    <div class="cd-filter-content">
                        <input class="date mb-3" type="date" id="date" name="date">
                        <select class="filter" name="time" id="timeThis">
                            <option value="">Любое время</option>
                            @for($hour = 6; $hour <= 23; $hour++)
                                @php
                                    $formattedTime = sprintf('%02d:00', $hour);
                                @endphp
                                <option value="{{$formattedTime}}">{{$formattedTime}}</option>
                            @endfor
                        </select>
                    </div> <!-- cd-filter-content -->
                </div><!-- cd-filter-block -->

                <div class="cd-filter-block">
                    <h5>Цена</h5>
                    <div class="cd-filter-content slider-container">
                        <label for="price">Максимальная цена (руб):</label>
                        <input type="range" id="price" name="price" min="0" max="10000" step="100" value="1000"
                               oninput="document.getElementById('price-value').textContent = this.value;">
                        <span id="price-value" class="slider-value">1000</span> <!-- Вывод текущего значения -->
                    </div> <!-- cd-filter-content -->
                </div><!-- cd-filter-block -->

                <div class="cd-filter-block">
                    <h5>Площадь</h5>
                    <div class="cd-filter-content slider-container">
                        <label for="area">Минимальная площадь (м²):</label>
                        <input type="range" id="area" name="area" min="0" max="150" step="10" value="70"
                               oninput="document.getElementById('area-value').textContent = this.value;">
                        <span id="area-value" class="slider-value">70</span> <!-- Вывод текущего значения -->
                    </div> <!-- cd-filter-content -->
                </div> <!-- cd-filter-block -->


                <div class="cd-filter-block">
                    <h5>Студии</h5>
                    <div class="cd-filter-content">
                        <div class="cd-select cd-filters">
                            <select class="filter" name="selectThis" id="selectThis">
                                <option value="">Любая студия</option>
                                @forelse($studios as $studio)
                                    <option
                                            value="{{ Str::slug($studio->name_studio) }}">{{$studio->name_studio}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div> <!-- cd-select -->
                    </div> <!-- cd-filter-content -->
                </div> <!-- cd-filter-block -->
            </form>

            <a href="#0" class="cd-close">&times;</a>
        </div> <!-- cd-filter -->
        <a href="#0" class="cd-filter-trigger">Фильтр</a>
    </main>
</x-layout>
<script src="/js/main.js"></script> <!-- Resource jQuery -->
<script src="/js/filter.js"></script>

