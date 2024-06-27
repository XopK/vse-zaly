<x-layout>
    <!-- Banner Section -->
    <section class="page-banner">
        <div class="image-layer" style="background-image:url(images/background/banner-image-2.jpg);"></div>
        <div class="banner-bottom-pattern"></div>

        <div class="banner-inner">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <h1>Room List</h1>
                    <div class="page-nav">
                        <ul class="bread-crumb clearfix">
                            <li><a href="index.html">Home</a></li>
                            <li class="active">Rooms List</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Banner Section -->

    <!--Rooms Section-->
    <section class="rooms-section rooms-list">
        <div class="auto-container">
            <!--Filters Section-->
            <div class="filters-section filters-container">
                <div class="form-box default-form filter-form wow fadeInUp" data-wow-delay="0ms"
                    data-wow-duration="1500ms">
                    <form method="post" action="room-single.html">
                        <div class="row clearfix">
                            <div class="form-group col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="field-label">Stay</div>
                                <div class="field-inner">
                                    <input id="arrival-date" class="date-picker" type="text" name="field-name"
                                        value="Nov 02. 2019" placeholder="">
                                    <label for="arrival-date" class="icon flaticon-down-arrow"></label>
                                </div>
                            </div>
                            <div class="form-group col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="field-label">Room type</div>
                                <div class="field-inner">
                                    <select class="custom-select-box">
                                        <option>Balcony Room</option>
                                        <option>Deluxe Room</option>
                                        <option>Superior Room</option>
                                        <option>Luxury Room</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="field-label">Guests</div>
                                <div class="field-inner">
                                    <div class="check-sel-box">
                                        <div class="check-sel-btn">
                                            <span class="adult-info">2 Adults.</span>
                                            <span class="child-info">1 Children</span>
                                        </div>
                                        <ul class="check-sel-droplist">
                                            <li>
                                                <div class="sel-title">Select Adults:</div>
                                                <div class="clearfix">
                                                    <div class="radio-block adult-block"><input type="radio"
                                                            name="adult-group" id="radio-1" value="1 Adults."><label
                                                            for="radio-1">1</label></div>
                                                    <div class="radio-block adult-block"><input type="radio"
                                                            name="adult-group" id="radio-2" value="2 Adults."
                                                            checked=""><label for="radio-2">2</label></div>
                                                    <div class="radio-block adult-block"><input type="radio"
                                                            name="adult-group" id="radio-3" value="3 Adults."><label
                                                            for="radio-3">3</label></div>
                                                    <div class="radio-block adult-block"><input type="radio"
                                                            name="adult-group" id="radio-4" value="4 Adults."><label
                                                            for="radio-4">4</label></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="sel-title">Select Children:</div>
                                                <div class="clearfix">
                                                    <div class="radio-block child-block"><input type="radio"
                                                            name="child-group" id="radio-5" value="1 Children"
                                                            checked=""><label for="radio-5">1</label></div>
                                                    <div class="radio-block child-block"><input type="radio"
                                                            name="child-group" id="radio-6" value="2 Children"><label
                                                            for="radio-6">2</label></div>
                                                    <div class="radio-block child-block"><input type="radio"
                                                            name="child-group" id="radio-7" value="3 Children"><label
                                                            for="radio-7">3</label></div>
                                                    <div class="radio-block child-block"><input type="radio"
                                                            name="child-group" id="radio-8" value="4 Children"><label
                                                            for="radio-8">4</label></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                <div class="field-label e-label">&nbsp;</div>
                                <div class="field-inner">
                                    <button class="theme-btn btn-style-one"><span class="btn-title">Start
                                            Filter</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="rooms-box">
                <!--Room-->
                <div class="room-block-four wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><img src="images/resource/featured-image-30.jpg" alt=""
                                    title=""></figure>
                            <div class="image-layer"
                                style="background-image: url(images/resource/featured-image-30.jpg);"></div>
                            <a class="overlink" href="room-single.html"></a>
                        </div>
                        <div class="content-box">
                            <div class="rating">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <h4>Balcony Room</h4>
                            <div class="text">Excepteur sint ocaecat cupidatat dent in sun in culpa qui officia
                                deserunt mollit anim estlabor sed ut perspiciatis unde omnis iste natus error sit
                                voluptatem acusantium doloremque laudan totam rem aperiam eaque ipsa quae.</div>
                            <div class="link-row clearfix">
                                <div class="pricing clearfix">
                                    <div class="price">From <span>$50.00</span></div>
                                </div>
                                <div class="link-box"><a href="room-single.html"
                                        class="theme-btn btn-style-one"><span class="btn-title">Book Now</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Room-->
                <div class="room-block-four wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><img src="images/resource/featured-image-31.jpg" alt=""
                                    title=""></figure>
                            <div class="image-layer"
                                style="background-image: url(images/resource/featured-image-31.jpg);"></div>
                            <a class="overlink" href="room-single.html"></a>
                        </div>
                        <div class="content-box">
                            <div class="rating">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <h4>Deluxe Room</h4>
                            <div class="text">Excepteur sint ocaecat cupidatat dent in sun in culpa qui officia
                                deserunt mollit anim estlabor sed ut perspiciatis unde omnis iste natus error sit
                                voluptatem acusantium doloremque laudan totam rem aperiam eaque ipsa quae.</div>
                            <div class="link-row clearfix">
                                <div class="pricing clearfix">
                                    <div class="price">From <span>$50.00</span></div>
                                </div>
                                <div class="link-box"><a href="room-single.html"
                                        class="theme-btn btn-style-one"><span class="btn-title">Book Now</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Room-->
                <div class="room-block-four wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><img src="images/resource/featured-image-32.jpg" alt=""
                                    title=""></figure>
                            <div class="image-layer"
                                style="background-image: url(images/resource/featured-image-32.jpg);"></div>
                            <a class="overlink" href="room-single.html"></a>
                        </div>
                        <div class="content-box">
                            <div class="rating">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <h4>Luxury Room</h4>
                            <div class="text">Excepteur sint ocaecat cupidatat dent in sun in culpa qui officia
                                deserunt mollit anim estlabor sed ut perspiciatis unde omnis iste natus error sit
                                voluptatem acusantium doloremque laudan totam rem aperiam eaque ipsa quae.</div>
                            <div class="link-row clearfix">
                                <div class="pricing clearfix">
                                    <div class="price">From <span>$50.00</span></div>
                                </div>
                                <div class="link-box"><a href="room-single.html"
                                        class="theme-btn btn-style-one"><span class="btn-title">Book Now</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Room-->
                <div class="room-block-four wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><img src="images/resource/featured-image-33.jpg" alt=""
                                    title=""></figure>
                            <div class="image-layer"
                                style="background-image: url(images/resource/featured-image-33.jpg);"></div>
                            <a class="overlink" href="room-single.html"></a>
                        </div>
                        <div class="content-box">
                            <div class="rating">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <h4>Sea View Room</h4>
                            <div class="text">Excepteur sint ocaecat cupidatat dent in sun in culpa qui officia
                                deserunt mollit anim estlabor sed ut perspiciatis unde omnis iste natus error sit
                                voluptatem acusantium doloremque laudan totam rem aperiam eaque ipsa quae.</div>
                            <div class="link-row clearfix">
                                <div class="pricing clearfix">
                                    <div class="price">From <span>$50.00</span></div>
                                </div>
                                <div class="link-box"><a href="room-single.html"
                                        class="theme-btn btn-style-one"><span class="btn-title">Book Now</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Room-->
                <div class="room-block-four wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><img src="images/resource/featured-image-34.jpg" alt=""
                                    title=""></figure>
                            <div class="image-layer"
                                style="background-image: url(images/resource/featured-image-34.jpg);"></div>
                            <a class="overlink" href="room-single.html"></a>
                        </div>
                        <div class="content-box">
                            <div class="rating">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <h4>Superior Room</h4>
                            <div class="text">Excepteur sint ocaecat cupidatat dent in sun in culpa qui officia
                                deserunt mollit anim estlabor sed ut perspiciatis unde omnis iste natus error sit
                                voluptatem acusantium doloremque laudan totam rem aperiam eaque ipsa quae.</div>
                            <div class="link-row clearfix">
                                <div class="pricing clearfix">
                                    <div class="price">From <span>$50.00</span></div>
                                </div>
                                <div class="link-box"><a href="room-single.html"
                                        class="theme-btn btn-style-one"><span class="btn-title">Book Now</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layout>
