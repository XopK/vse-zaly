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

        <section class="cd-gallery">
            @forelse($halls as $hall)
                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms"
                     data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="/hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}"><img
                                        src="/storage/photo_halls/{{$hall->preview_hall}}" alt="{{$hall->preview_hall}}"
                                        title="{{$hall->name_hall}}"></a>
                            </figure>
                        </div>
                        <div class="lower-box">
                            <h4>{{$hall->name_hall}}</h4>
                            <div class="pricing clearfix">
                                <div class="price">Площадь <span>{{$hall->area_hall}} м²</span></div>
                                {{-- <div class="rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div> --}}
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
            @endforelse
            {{--<ul>
                <li class="mix color-1 check1 radio2 option3"><img src="/img/img-1.jpg" alt="Image 1"></li>
                <li class="mix color-2 check2 radio2 option2"><img src="/img/img-2.jpg" alt="Image 2"></li>
                <li class="mix color-1 check3 radio3 option1"><img src="/img/img-3.jpg" alt="Image 3"></li>
                <li class="mix color-1 check3 radio2 option4"><img src="/img/img-4.jpg" alt="Image 4"></li>
                <li class="mix color-1 check1 radio3 option2"><img src="/img/img-5.jpg" alt="Image 5"></li>
                <li class="mix color-2 check2 radio3 option3"><img src="/img/img-6.jpg" alt="Image 6"></li>
                <li class="mix color-2 check2 radio2 option1"><img src="/img/img-7.jpg" alt="Image 7"></li>
                <li class="mix color-1 check1 radio3 option4"><img src="/img/img-8.jpg" alt="Image 8"></li>
                <li class="mix color-2 check1 radio2 option3"><img src="/img/img-9.jpg" alt="Image 9"></li>
                <li class="mix color-1 check3 radio2 option4"><img src="/img/img-10.jpg" alt="Image 10"></li>
                <li class="mix color-1 check3 radio3 option2"><img src="/img/img-11.jpg" alt="Image 11"></li>
                <li class="mix color-2 check1 radio3 option1"><img src="/img/img-12.jpg" alt="Image 12"></li>
                <li class="gap"></li>
                <li class="gap"></li>
                <li class="gap"></li>
            </ul>--}}
            <div class="cd-fail-message">No results found</div>
        </section> <!-- cd-gallery -->

        <div class="cd-filter">
            <form>
                <div class="cd-filter-block">
                    <h5>Поиск</h5>

                    <div class="cd-filter-content">
                        <input type="search" placeholder="Напишите зал или студию">
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
                        <input type="range" id="area" name="area" min="0" max="150" step="10" value="20"
                               oninput="document.getElementById('area-value').textContent = this.value;">
                        <span id="area-value" class="slider-value">20</span> <!-- Вывод текущего значения -->
                    </div> <!-- cd-filter-content -->
                </div> <!-- cd-filter-block -->

                <div class="cd-filter-block">
                    <h5>Удобства</h5>

                    <ul class="cd-filter-content cd-filters list">
                        <li>
                            <input class="filter checkbox-input" data-filter=".check1" type="checkbox" id="checkbox1">
                            <label class="checkbox-label" for="checkbox1">WI-FI</label>
                        </li>

                        <li>
                            <input class="filter checkbox-input" data-filter=".check2" type="checkbox" id="checkbox2">
                            <label class="checkbox-label" for="checkbox2">Зеркало</label>
                        </li>

                        <li>
                            <input class="filter checkbox-input" data-filter=".check3" type="checkbox" id="checkbox3">
                            <label class="checkbox-label" for="checkbox3">Кондиционер</label>
                        </li>

                        <li>
                            <input class="filter" data-filter=".check4" type="checkbox" id="checkbox4">
                            <label class="checkbox-label" for="checkbox4">Парковка на территории</label>
                        </li>
                    </ul>
                </div>


                <div class="cd-filter-block">
                    <h5>Студии</h5>
                    <div class="cd-filter-content">
                        <div class="cd-select cd-filters">
                            <select class="filter" name="selectThis" id="selectThis">
                                <option value="">Choose an option</option>
                                <option value=".option1">Option 1</option>
                                <option value=".option2">Option 2</option>
                                <option value=".option3">Option 3</option>
                                <option value=".option4">Option 4</option>
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
<script src="/js/jquery.mixitup.min.js"></script>
<script src="/js/main.js"></script> <!-- Resource jQuery -->

