<x-layout>
    <!-- Banner Section -->
    <section class="page-banner ext-banner">
        <div class="image-layer" style="background-image:url(/storage/photo_halls/{{$hall->preview_hall}});"></div>
        <div class="banner-bottom-pattern"></div>

        <div class="banner-inner">
            <div class="auto-container">
                <div class="inner-container clearfix">

                </div>
            </div>
        </div>
    </section>
    <!--End Banner Section -->

    <!--Room Single Section-->
    <section class="room-single">
        <div class="circles-two">
            <div class="c-1"></div>
            <div class="c-2"></div>
        </div>
        <span class="dotted-pattern dotted-pattern-3"></span>
        <span class="tri-pattern tri-pattern-3"></span>
        <div class="auto-container">
            <div class="upper-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                <div class="upper-inner">
                    <h2>{{$hall->name_hall}}</h2>
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
                    <div class="text">
                        <p>{{$hall->description_hall}}</p>
                        {{-- <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet consectetur adipisci velit sed
                            quia non numquam eius modi tempora incidunt labore dolore sit magnam aliquam quaerat
                            voluptatem.</p> --}}
                    </div>
                    <div class="text">
                        <p>{{$hall->address_hall}}</p>
                    </div>
                </div>
            </div>

            <div class="details-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                <div class="details-inner">
                    <h3>Зал предоставляет:</h3>
                    <div class="text">Короткое описание правил пользования данной студии*</div>
                    <ul class="info clearfix">
                        {{-- <li><span class="icon flaticon-tv"></span> Telivision</li> --}}
                        <li><span class="icon flaticon-wifi"></span> Wi-Fi</li>
                        <li><span class="icon flaticon-coffee-cup"></span> Кофе</li>
                        <li><span class="icon flaticon-wine-glass"></span> Мини бар</li>
                        {{-- <li><span class="icon flaticon-dumbbell"></span> Gymnasium</li> --}}
                    </ul>
                </div>
            </div>

            <div class="lower-box">
                <div class="row clearfix">
                    @forelse($hall->photo_halls as $photo)
                        <div class="image-block col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms"
                             data-wow-duration="1500ms">
                            <figure class="image"><a href="/storage/photo_halls/{{$photo->photo_hall}}"
                                                     class="lightbox-image"><img
                                        src="/storage/photo_halls/{{$photo->photo_hall}}"
                                        alt="{{$photo->photo_hall}}"
                                        title="{{$hall->name_hall}}"></a></figure>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!--Rooms Section-->
    <section class="rooms-section alternate">
        <span class="dotted-pattern dotted-pattern-3"></span>
        <span class="tri-pattern tri-pattern-3"></span>
        <div class="auto-container">
            <div class="sec-title centered">
                <h2>Похожие залы</h2>
                <div class="lower-text">Тут будут залы сперва залы которые предоставляет та же студия,
                    потом те которые подходят по той же сфере, в данном случае танцевальные*
                </div>
            </div>
            <div class="row clearfix">

                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms"
                     data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="room-single.html"><img
                                        src="images/resource/featured-image-21.jpg" alt="" title=""></a>
                            </figure>
                        </div>
                        <div class="lower-box">
                            <h4>Balcony Room</h4>
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

                            <div class="text">Excepteur sint occaecat cupidatat dent in sun in culpa qui officia
                                deserunt mollit anim id est.
                            </div>
                            <div class="link-box"><a href="room-single.html" class="theme-btn btn-style-three"><span
                                        class="btn-title">Check Availability</span></a></div>
                        </div>
                    </div>
                </div>

                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms"
                     data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="room-single.html"><img
                                        src="images/resource/featured-image-22.jpg" alt="" title=""></a>
                            </figure>
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

                            <div class="text">Excepteur sint occaecat cupidatat dent in sun in culpa qui officia
                                deserunt mollit anim id est.
                            </div>
                            <div class="link-box"><a href="room-single.html" class="theme-btn btn-style-three"><span
                                        class="btn-title">Check Availability</span></a></div>
                        </div>
                    </div>
                </div>

                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms"
                     data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="room-single.html"><img
                                        src="images/resource/featured-image-23.jpg" alt=""
                                        title=""></a></figure>
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

                            <div class="text">Excepteur sint occaecat cupidatat dent in sun in culpa qui officia
                                deserunt mollit anim id est.
                            </div>
                            <div class="link-box"><a href="room-single.html" class="theme-btn btn-style-three"><span
                                        class="btn-title">Check Availability</span></a></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layout>
