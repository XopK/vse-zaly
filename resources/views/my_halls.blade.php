<x-layout>
    <style>
        .hall_add {
            width: 80%;
            margin: 150px auto;
        }
    </style>
    <div class="hall_add">

        <div class="my-address contact-2">
            <h3 class="heading-3">Добавить новый зал</h3>
            <form action="{{ route('update_personal_data') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="form-group name">
                            <label>Название зала</label>
                            <input type="text" name="name_hall" class="form-control" value="{{ Auth::user()->name }}">
                        </div>
                        @error('name_hall')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-12 ">
                        <div class="form-group number">
                            <label>Площадь зала</label>
                            <input type="text" name="area_hall" class="form-control"
                                value="{{ Auth::user()->email }}">
                        </div>
                        @error('area_hall')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-12 ">
                        <div class="form-group subject">
                            <label>Описание зала</label>
                            <input id="description_hall" type="text" name="description_hall" class="form-control"
                                value="{{ Auth::user()->phone }}">
                        </div>
                        @error('description_hall')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-12 ">
                        <div class="form-group photo">
                            <label>Фото зала(чтобы несколько фото можно было выбрать)</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="photo_hall" accept="image/*"
                                        id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Выберите
                                        файл/ы</label>
                                </div>
                            </div>
                        </div>
                        @error('photo_hall')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                    </div>
                    <h4 style="margin-left: 15px;">Что есть в зале</h4>
                    <div class="col-lg-12 ">
                        <div class="form-group subject">
                            <input id="coffee_hall" type="checkbox" name="coffee_hall">
                            <label>
                                <li><span class="icon flaticon-coffee-cup"></span> Кофе</li>
                            </label>
                            <input id="bar_hall" type="checkbox" name="bar_hall">
                            <label>
                                <li><span class="icon flaticon-wine-glass"></span> Мини-бар</li>
                            </label>
                            <input id="wifi_hall" type="checkbox" name="wifi_hall">
                            <label>
                                <li><span class="icon flaticon-wifi"></span> Wi-Fi</li>
                            </label>
                            <input id="tv_hall" type="checkbox" name="tv_hall">
                            <label>
                                <li><span class="icon flaticon-tv"></span> Телевизор</li>
                            </label>
                            <input id="lamp_hall" type="checkbox" name="lamp_hall">
                            <label>
                                <li><span class="icon flaticon-light"></span> Свет</li>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="send-btn">
                            <button type="submit" class="theme-btn btn-style-one"><span
                                    class="btn-title">Добавить</span></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <!--Rooms Section-->
    <section class="rooms-section" style="margin-top: 40px">
        <div class="auto-container">

            <div class="row clearfix">
                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms"
                    data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="/hall"><img src="images/halls/IMG_5431.jpeg"
                                        alt="" title=""></a></figure>
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
                            <div class="link-box"><a href="/my_hall" class="theme-btn btn-style-three"><span
                                        class="btn-title">Редактировать зал</span></a></div>
                        </div>
                    </div>
                </div>

                <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms"
                    data-wow-duration="1500ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="/hall"><img src="images/resource/featured-image-22.jpg"
                                        alt="" title=""></a></figure>
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
                                deserunt mollit anim id est.</div>
                            <div class="link-box"><a href="/hall" class="theme-btn btn-style-three"><span
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
                                        title=""></a>
                            </figure>
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
                                deserunt mollit anim id est.</div>
                            <div class="link-box"><a href="room-single.html" class="theme-btn btn-style-three"><span
                                        class="btn-title">Check Availability</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
