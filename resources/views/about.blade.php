<x-layout>
    <!-- Banner Section -->
    <section class="page-banner">
        <div class="image-layer" style="background-image:url(images/background/about_us.jpg);"></div>
        <div class="banner-bottom-pattern"></div>

        <div class="banner-inner">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <h1>О нас</h1>
                </div>
            </div>
        </div>
    </section>
    <!--End Banner Section -->

    <!--Featured Section-->
    <section class="featured-section-four about-page">
        <span class="dotted-pattern dotted-pattern-11"></span>
        <div class="circles-two">
            <div class="c-1"></div>
            <div class="c-2"></div>
        </div>
        <div class="auto-container">
            <div class="row clearfix">
                <!--Text Column-->
                <div class="text-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner">
                        <div class="sec-title">
                            <h2>Сотрудничаем с ведущими студиями</h2>
                        </div>
                        <div class="text">С нами работают множество студий. Присоединяйтесь к нам сегодня и начните
                            сотрудничество
                            с профессионалами, чтобы вывести ваш бизнес на новый уровень!
                        </div>
                        <a href="/become_partner" class="features">
                            Стать партнером
                        </a>
                    </div>
                </div>
                <!--Image Column-->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner">
                        <span class="dotted-pattern dotted-pattern-10"></span>
                        <div class="image-box clearfix">
                            @forelse($studios as $studio)
                                <figure class="image wow fadeInUp" data-wow-delay="1000ms" data-wow-duration="1500ms">
                                    <img
                                        src="/storage/photo_studios/{{$studio->photo_studio}}"
                                        alt="{{$studio->photo_studio}}" title="{{$studio->name_studio}}">
                                </figure>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Facts Section-->
    <section class="facts-section-two alternate">
        <div class="circles">
            <div class="c-1"></div>
            <div class="c-2"></div>
        </div>
        <div class="auto-container">
            <div class="sec-title">
                <h2>С нами бронирование залов станет ещё проще</h2>
                <div class="lower-text">С нами бронирование залов станет ещё проще и удобнее.
                    Мы обеспечим вам легкость и комфорт на каждом этапе, от выбора зала до подтверждения брони,
                    чтобы вы могли сосредоточиться на других важных аспектах вашей деятельности
                </div>
            </div>
            <!--Facts Column-->
            <div class="facts-box">
                <div class="row clearfix">
                    <div class="fact-block col-lg-4 col-md-6 col-sm-12">
                        <div class="fact-inner">
                            <div class="fact-count wow zoomInStable" data-wow-delay="0ms" data-wow-duration="2000ms">
                                <div class="count-box counted"><span class="count-text" data-stop="25"
                                                                     data-speed="2000">3</span>+
                                </div>
                            </div>
                            <h4>Лет успешного сотрудничества</h4>
                            <div class="text">Добились высокого качества услуг и доверия наших партнеров</div>
                        </div>
                    </div>
                    <div class="fact-block col-lg-4 col-md-6 col-sm-12">
                        <div class="fact-inner">
                            <div class="fact-count wow zoomInStable" data-wow-delay="300ms" data-wow-duration="2000ms">
                                <div class="count-box counted"><span class="count-text" data-stop="712"
                                                                     data-speed="5000">14</span></div>
                            </div>
                            <h4>Студий уже с нами</h4>
                            <div class="text">Расширяем свои горизонты</div>
                        </div>
                    </div>
                    <div class="fact-block col-lg-4 col-md-6 col-sm-12">
                        <div class="fact-inner">
                            <div class="fact-count wow zoomInStable" data-wow-delay="600ms" data-wow-duration="2000ms">
                                <div class="count-box counted"><span class="count-text" data-stop="310"
                                                                     data-speed="4000">41</span></div>
                            </div>
                            <h4>Мероприятий</h4>
                            <div class="text">Организовали множество мероприятий</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!--Why Section-->
    {{-- <section class="history-section">
        <span class="dotted-pattern dotted-pattern-6"></span>
        <span class="tri-pattern tri-pattern-5"></span>
        <div class="circles">
            <div class="c-1"></div>
            <div class="c-2"></div>
        </div>
        <div class="auto-container">
            <div class="sec-title centered">
                <h2>Our History</h2>
                <div class="lower-text">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt
                    mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</div>
            </div>
            <div class="h-container">
                <!--Block-->
                <div class="history-block">
                    <div class="row clearfix">
                        <div class="content-col col-lg-6 col-md-6 col-sm-12">
                            <div class="inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <div class="image-box">
                                    <div class="image"><img src="images/resource/featured-image-18.jpg"
                                            alt="">
                                    </div>
                                </div>
                                <div class="lower-box">
                                    <h3>The Beginning</h3>
                                    <div class="text">Sint occaecat cuidatat non proident sunt in culpa qui officia
                                        mollit anim id est laborum perspiciatis.</div>
                                </div>
                            </div>
                        </div>
                        <div class="empty-col col-lg-6 col-md-6 col-sm-12">

                        </div>
                    </div>
                </div>
                <!--Block-->
                <div class="history-block alternate">
                    <div class="row clearfix">
                        <div class="content-col col-lg-6 col-md-6 col-sm-12">
                            <div class="inner wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <div class="image-box">
                                    <div class="image"><img src="images/resource/featured-image-19.jpg"
                                            alt="">
                                    </div>
                                </div>
                                <div class="lower-box">
                                    <h3>2002 The Beginning</h3>
                                    <div class="text">Sint occaecat cuidatat non proident sunt in culpa qui officia
                                        mollit anim id est laborum perspiciatis.</div>
                                </div>
                            </div>
                        </div>
                        <div class="empty-col col-lg-6 col-md-6 col-sm-12">

                        </div>
                    </div>
                </div>
                <!--Block-->
                <div class="history-block">
                    <div class="row clearfix">
                        <div class="content-col col-lg-6 col-md-6 col-sm-12">
                            <div class="inner wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <div class="image-box">
                                    <div class="image"><img src="images/resource/featured-image-20.jpg"
                                            alt="">
                                    </div>
                                </div>
                                <div class="lower-box">
                                    <h3>2011 The Mid-Term</h3>
                                    <div class="text">Sint occaecat cuidatat non proident sunt in culpa qui officia
                                        mollit anim id est laborum perspiciatis.</div>
                                </div>
                            </div>
                        </div>
                        <div class="empty-col col-lg-6 col-md-6 col-sm-12">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!--Testimonials Section-->
    <section class="testimonials-section">
        <div class="circles-two">
            <div class="c-1"></div>
            <div class="c-2"></div>
        </div>
        <div class="auto-container">
            <div class="sec-title centered">
                <h2>Отзывы</h2>
                <div class="lower-text">Нам важно что вы думаете о нас, мы за то - чтобы наш проект развивался вместе с
                    вами.
                </div>
            </div>

            <div class="carousel-box">
                <div class="testimonial-carousel owl-theme owl-carousel">
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-1.jpg" alt="">
                                </div>
                                <div class="name">Mark Adams</div>
                                <div class="designation">Designer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-2.jpg" alt="">
                                </div>
                                <div class="name">Fiona Edwards</div>
                                <div class="designation">Developer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-3.jpg" alt="">
                                </div>
                                <div class="name">Dominic Allen</div>
                                <div class="designation">Designer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-1.jpg" alt="">
                                </div>
                                <div class="name">Mark Adams</div>
                                <div class="designation">Designer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-2.jpg" alt="">
                                </div>
                                <div class="name">Fiona Edwards</div>
                                <div class="designation">Developer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-3.jpg" alt="">
                                </div>
                                <div class="name">Dominic Allen</div>
                                <div class="designation">Designer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-1.jpg" alt="">
                                </div>
                                <div class="name">Mark Adams</div>
                                <div class="designation">Designer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-2.jpg" alt="">
                                </div>
                                <div class="name">Fiona Edwards</div>
                                <div class="designation">Developer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-3.jpg" alt="">
                                </div>
                                <div class="name">Dominic Allen</div>
                                <div class="designation">Designer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
