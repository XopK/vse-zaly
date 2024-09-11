<x-layout>
    <link rel="stylesheet" href="/css/styles.css"> <!-- Resource style -->
    <script src="/js/modernizr.js"></script> <!-- Modernizr -->
    <main class="cd-main-content" style="margin-top: 30px">
        <div class="cd-tab-filter-wrapper">
            <div class="cd-tab-filter">
                <ul class="cd-filters">
                    <li class="placeholder">
                        <a data-type="all" href="#0">Все</a> <!-- selected option on mobile -->
                    </li>
                    <li class="filter" data-filter="#all"><a class="selected">Все</a></li>
                    <li class="filter" data-filter="#asc"><a>По возрастанию ₽</a></li>
                    <li class="filter" data-filter="#desc"><a>По убыванию ₽</a></li>
                </ul> <!-- cd-filters -->
            </div> <!-- cd-tab-filter -->
        </div> <!-- cd-tab-filter-wrapper -->

        <section class="cd-gallery" id="halls-container">
            @include('partials.halls', ['halls' => $halls])
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
                        <input type="range" id="price" name="price" min="0" max="5000" step="10" value="1000"
                               oninput="document.getElementById('price-value').textContent = this.value;">
                        <span id="price-value" class="slider-value">1000</span> <!-- Вывод текущего значения -->
                    </div> <!-- cd-filter-content -->
                </div><!-- cd-filter-block -->

                <div class="cd-filter-block">
                    <h5>Площадь</h5>
                    <div class="cd-filter-content slider-container">
                        <label for="area">Минимальная площадь (м²):</label>
                        <input type="range" id="area" name="area" min="0" max="150" step="10" value="150"
                               oninput="document.getElementById('area-value').textContent = this.value;">
                        <span id="area-value" class="slider-value">150</span> <!-- Вывод текущего значения -->
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
                                        value="{{ $studio->id }}">{{$studio->name_studio}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <a href="#0" class="cd-close">&times;</a>
        </div>
        <a href="#0" class="cd-filter-trigger">Фильтр</a>

    </main>
    <div id="pagination-container" class="pagination-links p-3 mb-3">
        {{ $halls->links() }}
    </div>
</x-layout>
<script src="/js/main.js"></script> <!-- Resource jQuery -->
<script src="/js/filter.js"></script>

