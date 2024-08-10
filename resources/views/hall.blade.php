<x-layout>
    <style>
        /* Контейнер для сердечка */
        .heart-container {
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-top: -30px;
        }

        /* Основные стили для сердечка */
        .heart {
            width: 24px;
            height: 24px;
            position: relative;
            background-color: black;
            /* Цвет сердечка до изменения */
            transform: rotate(315deg);
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin: 15px;
            
        }

        /* Левая половинка сердечка */
        .heart::before,
        .heart::after {
            content: "";
            position: absolute;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: black;
            /* Цвет сердечка до изменения */
            transition: background-color 0.3s ease;
        }

        /* Позиционирование левой половинки */
        .heart::before {
            top: -12px;
            left: 0;
        }

        /* Позиционирование правой половинки */
        .heart::after {
            left: 12px;
            top: 0;
        }

        /* Эффект изменения цвета и увеличения при клике */
        .heart-container.active .heart,
        .heart-container:hover .heart {
            background-color: red;
            /* Цвет сердечка после изменения */
            transform: rotate(315deg) scale(1.2);
            /* Немного увеличиваем сердечко */
        }

        .heart-container.active .heart::before,
        .heart-container.active .heart::after,
        .heart-container:hover .heart::before,
        .heart-container:hover .heart::after {
            background-color: red;
            /* Цвет сердечка после изменения */
        }
    </style>
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
                        <div class="price">Площадь <span>{{$hall->area_hall}} м²</span></div>
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
                    </div>
                    <div class="text">
                        <p><i class="fa fa-map-marker" aria-hidden="true"
                                style="margin-right: 10px"></i>{{$hall->address_hall}} </p>
                    </div>
                    <div class="col-xl-3" style="padding: 0">
                        <button type="button" class="theme-btn btn-style-one btn-block" data-toggle="modal"
                            data-target="#booking"><span
                                class="btn-title">Забронировать</span></button>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="heart-container">
                        <div class="heart"></div>
                        <p>Добавить в избранное</p>
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
                                    alt="{{$photo->photo_hall}}"></a>

                        </figure>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</x-layout>
<x-booking :hall="$hall" :bookings="$bookings"></x-booking>
<script>
    document.querySelector('.heart-container').addEventListener('click', function() {
        this.classList.toggle('active');
    });
</script>