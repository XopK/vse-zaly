<x-layout>
    <style>
        .auto-container {
            display: flex;
            gap: 50px;
            width: 100%;
        }

        form {
            width: 400px;
        }
    </style>

    <!--Rooms Section-->

    <section class="rooms-section" style="margin-top: 40px">
        <!-- <a href="/test">test</a> -->
        <div class="auto-container">
            <!--Filters Section-->
            <div class="filters-section filters-container">
                <div class="form-box default-form filter-form wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <!-- <form class="form_filter" action="">
                        <label for="name">Поиск по названию</label>
                        <input id="name" class="form-control" type="text">
                        <label for="areaRange">Площадь зала (м²)</label>
                        <div class="d-flex">
                            <input type="number" class="form-control mr-2" id="areaMin" placeholder="Min" min="0" max="500">
                            <input type="range" class="form-control-range mx-2" id="areaRangeMin" min="0" max="500" step="1">
                            <input type="range" class="form-control-range mx-2" id="areaRangeMax" min="0" max="500" step="1">
                            <input type="number" class="form-control ml-2" id="areaMax" placeholder="Max" min="0" max="500">
                        </div>
                    </form> -->
                    <form class="filterform" id="filterForm">

                            <label for="name">Поиск по названию</label>
                            <input type="text" class="form-control" id="name">

                            <label for="areaRange">Площадь зала (м²)</label>
                            <div class="d-flex">
                                <input type="number" class="form-control mr-2" id="areaMin" placeholder="Min" min="0" max="500">
                                <input type="range" class="form-control-range mx-2" id="areaRangeMin" min="0" max="500" step="1">
                                <input type="range" class="form-control-range mx-2" id="areaRangeMax" min="0" max="500" step="1">
                                <input type="number" class="form-control ml-2" id="areaMax" placeholder="Max" min="0" max="500">
                            </div>

                            <label for="priceRange">Цена (руб/ч)</label>
                            <div class="d-flex">
                                <input type="number" class="form-control mr-2" id="priceMin" placeholder="Min" min="0" max="10000">
                                <input type="range" class="form-control-range mx-2" id="priceRangeMin" min="0" max="10000" step="100">
                                <input type="range" class="form-control-range mx-2" id="priceRangeMax" min="0" max="10000" step="100">
                                <input type="number" class="form-control ml-2" id="priceMax" placeholder="Max" min="0" max="10000">
                            </div>

                            <label>Удобства</label><br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cooler">
                                <label class="form-check-label" for="cooler">Кулер с водой</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="lighting">
                                <label class="form-check-label" for="lighting">Подсветка</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="speaker">
                                <label class="form-check-label" for="speaker">Колонка</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="wifi">
                                <label class="form-check-label" for="wifi">Wi-Fi</label>
                            </div>

                            <label for="sort">Сортировка по цене</label>
                            <select class="form-control" id="sort">
                                <option value="asc">По возрастанию</option>
                                <option value="desc">По убыванию</option>
                            </select>
                        <br>
                        <button type="submit" class="btn btn-primary">Применить фильтр</button>
                    </form>
                </div>
            </div>
            <div class="row clearfix">
                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="/hall"><img src="/images/halls/IMG_5431.jpeg" alt="" title=""></a></figure>
                        </div>
                        <div class="lower-box">
                            <h4>Зал Нефть</h4>
                            <div class="pricing clearfix">
                                <div class="price">Площадь <span>78</span></div>
                                <div class="rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                            </div>

                            <div class="text">Самый популярный для видео-съемок, самый большой зал</div>
                            <div class="link-box"><a href="/hall" class="theme-btn btn-style-three"><span class="btn-title">Просмотреть</span></a></div>
                        </div>
                    </div>
                </div>

                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="/hall"><img src="/images/resource/featured-image-22.jpg" alt="" title=""></a></figure>
                        </div>
                        <div class="lower-box">
                            <h4>Deluxe Room</h4>
                            <div class="pricing clearfix">
                                <div class="price">From <span>$50.00</span></div>
                                <div class="rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                            </div>

                            <div class="text">Excepteur sint occaecat cupidatat dent in sun in culpa qui officia deserunt mollit anim id est.</div>
                            <div class="link-box"><a href="/hall" class="theme-btn btn-style-three"><span class="btn-title">Check Availability</span></a></div>
                        </div>
                    </div>
                </div>

                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="room-single.html"><img src="/images/resource/featured-image-23.jpg" alt="" title=""></a></figure>
                        </div>
                        <div class="lower-box">
                            <h4>Luxury Room</h4>
                            <div class="pricing clearfix">
                                <div class="price">From <span>$50.00</span></div>
                                <div class="rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                            </div>

                            <div class="text">Excepteur sint occaecat cupidatat dent in sun in culpa qui officia deserunt mollit anim id est.</div>
                            <div class="link-box"><a href="room-single.html" class="theme-btn btn-style-three"><span class="btn-title">Check Availability</span></a></div>
                        </div>
                    </div>
                </div>

                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="room-single.html"><img src="/images/resource/featured-image-24.jpg" alt="" title=""></a></figure>
                        </div>
                        <div class="lower-box">
                            <h4>Sea View Room</h4>
                            <div class="pricing clearfix">
                                <div class="price">From <span>$50.00</span></div>
                                <div class="rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                            </div>

                            <div class="text">Excepteur sint occaecat cupidatat dent in sun in culpa qui officia deserunt mollit anim id est.</div>
                            <div class="link-box"><a href="room-single.html" class="theme-btn btn-style-three"><span class="btn-title">Check Availability</span></a></div>
                        </div>
                    </div>
                </div>

                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="room-single.html"><img src="/images/resource/featured-image-25.jpg" alt="" title=""></a></figure>
                        </div>
                        <div class="lower-box">
                            <h4>Superior Room</h4>
                            <div class="pricing clearfix">
                                <div class="price">From <span>$50.00</span></div>
                                <div class="rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                            </div>

                            <div class="text">Excepteur sint occaecat cupidatat dent in sun in culpa qui officia deserunt mollit anim id est.</div>
                            <div class="link-box"><a href="room-single.html" class="theme-btn btn-style-three"><span class="btn-title">Check Availability</span></a></div>
                        </div>
                    </div>
                </div>

                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="room-single.html"><img src="/images/resource/featured-image-26.jpg" alt="" title=""></a></figure>
                        </div>
                        <div class="lower-box">
                            <h4>Signature Room</h4>
                            <div class="pricing clearfix">
                                <div class="price">From <span>$50.00</span></div>
                                <div class="rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                            </div>

                            <div class="text">Excepteur sint occaecat cupidatat dent in sun in culpa qui officia deserunt mollit anim id est.</div>
                            <div class="link-box"><a href="room-single.html" class="theme-btn btn-style-three"><span class="btn-title">Check Availability</span></a></div>
                        </div>
                    </div>
                </div>

                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="room-single.html"><img src="/images/resource/featured-image-27.jpg" alt="" title=""></a></figure>
                        </div>
                        <div class="lower-box">
                            <h4>Luxury Suite Room</h4>
                            <div class="pricing clearfix">
                                <div class="price">From <span>$50.00</span></div>
                                <div class="rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                            </div>

                            <div class="text">Excepteur sint occaecat cupidatat dent in sun in culpa qui officia deserunt mollit anim id est.</div>
                            <div class="link-box"><a href="room-single.html" class="theme-btn btn-style-three"><span class="btn-title">Check Availability</span></a></div>
                        </div>
                    </div>
                </div>

                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="room-single.html"><img src="/images/resource/featured-image-28.jpg" alt="" title=""></a></figure>
                        </div>
                        <div class="lower-box">
                            <h4>Queen Room Balcony</h4>
                            <div class="pricing clearfix">
                                <div class="price">From <span>$50.00</span></div>
                                <div class="rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                            </div>

                            <div class="text">Excepteur sint occaecat cupidatat dent in sun in culpa qui officia deserunt mollit anim id est.</div>
                            <div class="link-box"><a href="room-single.html" class="theme-btn btn-style-three"><span class="btn-title">Check Availability</span></a></div>
                        </div>
                    </div>
                </div>

                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="room-single.html"><img src="/images/resource/featured-image-29.jpg" alt="" title=""></a></figure>
                        </div>
                        <div class="lower-box">
                            <h4>Studio Sea View</h4>
                            <div class="pricing clearfix">
                                <div class="price">From <span>$50.00</span></div>
                                <div class="rating">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                            </div>

                            <div class="text">Excepteur sint occaecat cupidatat dent in sun in culpa qui officia deserunt mollit anim id est.</div>
                            <div class="link-box"><a href="room-single.html" class="theme-btn btn-style-three"><span class="btn-title">Check Availability</span></a></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layout>
