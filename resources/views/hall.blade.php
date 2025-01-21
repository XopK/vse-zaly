<x-layout>
    <script
        src="https://api-maps.yandex.ru/v3/?apikey={{config('services.yandex_geocoding.api_key')}}&lang=ru_RU"></script>
    <style>
        svg {
            cursor: pointer;
            overflow: visible;


            #heart {
                transform-origin: center;
                animation: animateHeartOut .3s linear forwards;
            }

            #main-circ {
                transform-origin: 29.5px 29.5px;
            }
        }

        #checkbox {
            display: none;
        }

        #checkbox:checked + label svg {
            #heart {
                transform: scale(.2);
                fill: #E2264D;
                animation: animateHeart .3s linear forwards .25s;
            }

            #main-circ {
                transition: all 2s;
                animation: animateCircle .3s linear forwards;
                opacity: 1;
            }

            #grp1 {
                opacity: 1;
                transition: .1s all .3s;

                #oval1 {
                    transform: scale(0) translate(0, -30px);
                    transform-origin: 0 0 0;
                    transition: .5s transform .3s;
                }

                #oval2 {
                    transform: scale(0) translate(10px, -50px);
                    transform-origin: 0 0 0;
                    transition: 1.5s transform .3s;
                }
            }

            #grp2 {
                opacity: 1;
                transition: .1s all .3s;

                #oval1 {
                    transform: scale(0) translate(30px, -15px);
                    transform-origin: 0 0 0;
                    transition: .5s transform .3s;
                }

                #oval2 {
                    transform: scale(0) translate(60px, -15px);
                    transform-origin: 0 0 0;
                    transition: 1.5s transform .3s;
                }
            }

            #grp3 {
                opacity: 1;
                transition: .1s all .3s;

                #oval1 {
                    transform: scale(0) translate(30px, 0px);
                    transform-origin: 0 0 0;
                    transition: .5s transform .3s;
                }

                #oval2 {
                    transform: scale(0) translate(60px, 10px);
                    transform-origin: 0 0 0;
                    transition: 1.5s transform .3s;
                }
            }

            #grp4 {
                opacity: 1;
                transition: .1s all .3s;

                #oval1 {
                    transform: scale(0) translate(30px, 15px);
                    transform-origin: 0 0 0;
                    transition: .5s transform .3s;
                }

                #oval2 {
                    transform: scale(0) translate(40px, 50px);
                    transform-origin: 0 0 0;
                    transition: 1.5s transform .3s;
                }
            }

            #grp5 {
                opacity: 1;
                transition: .1s all .3s;

                #oval1 {
                    transform: scale(0) translate(-10px, 20px);
                    transform-origin: 0 0 0;
                    transition: .5s transform .3s;
                }

                #oval2 {
                    transform: scale(0) translate(-60px, 30px);
                    transform-origin: 0 0 0;
                    transition: 1.5s transform .3s;
                }
            }

            #grp6 {
                opacity: 1;
                transition: .1s all .3s;

                #oval1 {
                    transform: scale(0) translate(-30px, 0px);
                    transform-origin: 0 0 0;
                    transition: .5s transform .3s;
                }

                #oval2 {
                    transform: scale(0) translate(-60px, -5px);
                    transform-origin: 0 0 0;
                    transition: 1.5s transform .3s;
                }
            }

            #grp7 {
                opacity: 1;
                transition: .1s all .3s;

                #oval1 {
                    transform: scale(0) translate(-30px, -15px);
                    transform-origin: 0 0 0;
                    transition: .5s transform .3s;
                }

                #oval2 {
                    transform: scale(0) translate(-55px, -30px);
                    transform-origin: 0 0 0;
                    transition: 1.5s transform .3s;
                }
            }

            #grp2 {
                opacity: 1;
                transition: .1s opacity .3s;
            }

            #grp3 {
                opacity: 1;
                transition: .1s opacity .3s;
            }

            #grp4 {
                opacity: 1;
                transition: .1s opacity .3s;
            }

            #grp5 {
                opacity: 1;
                transition: .1s opacity .3s;
            }

            #grp6 {
                opacity: 1;
                transition: .1s opacity .3s;
            }

            #grp7 {
                opacity: 1;
                transition: .1s opacity .3s;
            }
        }

        @keyframes animateCircle {
            40% {
                transform: scale(10);
                opacity: 1;
                fill: #DD4688;
            }

            55% {
                transform: scale(11);
                opacity: 1;
                fill: #D46ABF;
            }

            65% {
                transform: scale(12);
                opacity: 1;
                fill: #CC8EF5;
            }

            75% {
                transform: scale(13);
                opacity: 1;
                fill: transparent;
                stroke: #CC8EF5;
                stroke-width: .5;
            }

            85% {
                transform: scale(17);
                opacity: 1;
                fill: transparent;
                stroke: #CC8EF5;
                stroke-width: .2;
            }

            95% {
                transform: scale(18);
                opacity: 1;
                fill: transparent;
                stroke: #CC8EF5;
                stroke-width: .1;
            }

            100% {
                transform: scale(19);
                opacity: 1;
                fill: transparent;
                stroke: #CC8EF5;
                stroke-width: 0;
            }
        }

        @keyframes animateHeart {
            0% {
                transform: scale(.2);
            }

            40% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes animateHeartOut {
            0% {
                transform: scale(1.4);
            }

            100% {
                transform: scale(1);
            }
        }

        .stfu {
            display: flex;
            align-items: center;
        }

        label {
            cursor: pointer;
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
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>{{$hall->name_hall}}</h2>
                        <h5>Студия: <a
                                href="/about_studio/{{$hall->studio->id}}-{{Str::slug($hall->studio->name_studio)}}"
                                target="_blank">{{ $hall->studio->name_studio }}</a></h5>
                    </div>

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
                    <div class="text">
                        <p>{!! nl2br(e($hall->description_hall)) !!}</p>
                    </div>
                    <div class="text">
                        <p><i class="fa fa-map-marker" aria-hidden="true"
                              style="margin-right: 10px"></i>{{$hall->address_hall}} </p>
                    </div>
                    @auth
                        <div class="row d-flex justify-content-between">

                            @if(Auth::user()->id_role == 2)
                                @if(Auth::user()->studio->id == $hall->id_studio)
                                    <div class="col-lg-3 mb-3 ">
                                        <button type="button" class="theme-btn btn-style-one btn-block"
                                                data-toggle="modal"
                                                data-target="#warning"><span
                                                class="btn-title">Забронировать</span></button>
                                    </div>
                                @else
                                    <div class="col-lg-3 mb-3 ">
                                        <button type="button" class="theme-btn btn-style-one btn-block"
                                                data-toggle="modal"
                                                data-target="#booking"><span
                                                class="btn-title">Забронировать</span></button>
                                    </div>
                                @endif
                            @endif


                            @if(Auth::user()->id_role == 1)
                                <div class="col-lg-3 mb-3 ">
                                    <button type="button" class="theme-btn btn-style-one btn-block" data-toggle="modal"
                                            data-target="#booking"><span
                                            class="btn-title">Забронировать</span></button>
                                </div>
                            @endif

                            <div class="col-lg-3 px-0">
                                <div class="stfu" style="user-select: none;">
                                    <input type="checkbox" id="checkbox"
                                           data-item-id="{{ $hall->id }}" {{ $isFavorite ? 'checked' : '' }}>
                                    <label for="checkbox">
                                        <svg id="heart-svg" viewBox="467 392 58 57" xmlns="http://www.w3.org/2000/svg">
                                            <g id="Group" fill="none" fill-rule="evenodd"
                                               transform="translate(467 392)">
                                                <path
                                                    d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z"
                                                    id="heart" fill="#AAB8C2"/>
                                                <circle id="main-circ" fill="#E2264D" opacity="0" cx="29.5" cy="29.5"
                                                        r="1.5"/>

                                                <g id="grp7" opacity="0" transform="translate(7 6)">
                                                    <circle id="oval1" fill="#9CD8C3" cx="2" cy="6" r="2"/>
                                                    <circle id="oval2" fill="#8CE8C3" cx="5" cy="2" r="2"/>
                                                </g>

                                                <g id="grp6" opacity="0" transform="translate(0 28)">
                                                    <circle id="oval1" fill="#CC8EF5" cx="2" cy="7" r="2"/>
                                                    <circle id="oval2" fill="#91D2FA" cx="3" cy="2" r="2"/>
                                                </g>

                                                <g id="grp3" opacity="0" transform="translate(52 28)">
                                                    <circle id="oval2" fill="#9CD8C3" cx="2" cy="7" r="2"/>
                                                    <circle id="oval1" fill="#8CE8C3" cx="4" cy="2" r="2"/>
                                                </g>

                                                <g id="grp2" opacity="0" transform="translate(44 6)">
                                                    <circle id="oval2" fill="#CC8EF5" cx="5" cy="6" r="2"/>
                                                    <circle id="oval1" fill="#CC8EF5" cx="2" cy="2" r="2"/>
                                                </g>

                                                <g id="grp5" opacity="0" transform="translate(14 50)">
                                                    <circle id="oval1" fill="#91D2FA" cx="6" cy="5" r="2"/>
                                                    <circle id="oval2" fill="#91D2FA" cx="2" cy="2" r="2"/>
                                                </g>

                                                <g id="grp4" opacity="0" transform="translate(35 50)">
                                                    <circle id="oval1" fill="#F48EA7" cx="6" cy="5" r="2"/>
                                                    <circle id="oval2" fill="#F48EA7" cx="2" cy="2" r="2"/>
                                                </g>

                                                <g id="grp1" opacity="0" transform="translate(24)">
                                                    <circle id="oval1" fill="#9FC7FA" cx="2.5" cy="3" r="2"/>
                                                    <circle id="oval2" fill="#9FC7FA" cx="7.5" cy="2" r="2"/>
                                                </g>
                                            </g>
                                        </svg>
                                    </label>
                                    <label for="checkbox">Добавить в избранное</label>
                                </div>
                            </div>
                        </div>
                    @endauth
                    @guest
                        <div class="col-xl-3" style="padding: 0">
                            <button type="button" class="theme-btn btn-style-one btn-block" data-toggle="modal"
                                    data-target="#logModal"><span
                                    class="btn-title">Забронировать</span></button>
                        </div>
                    @endguest
                </div>
            </div>

            <div class="details-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                <div class="details-inner">
                    <h3>Зал предоставляет:</h3>
                    <div class="text">Правила: {!! nl2br(e($hall->rule_hall)) !!}</div>
                    <ul class="info clearfix">
                        @forelse($hall->features as $feature)
                            <li><img class="icon" src="/images/features/{{$feature->photo_feature}}"
                                     alt="{{$feature->photo_feature}}">{{$feature->title_feature}}
                            </li>
                        @empty
                            <li>Удобства отсутствуют</li>
                        @endforelse
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
            <div class="centered" style="margin-top: 50px;">
                <h2>Адрес</h2>
                <div class="sec-title d-flex" style="position: relative;">
                    <div id="map" style="width: 100%; height: 450px;"></div>
                    <div class="contact-info">
                        <h5>{{$hall->address_hall}}</h5>
                        <p>Телефон: <a href="tel:{{$hall->studio->phone_studio}}">{{$hall->studio->phone_studio}}</a>
                        </p>
                        <p>Почта: <a href="mailto:{{$hall->studio->email_studio}}">{{$hall->studio->email_studio}}</a>
                        </p>
                    </div>
                </div>
            </div>

            {{--<div class="reviews">
                <h2 style="text-align: center">Отзывы</h2>

            </div>--}}
        </div>
    </section>
</x-layout>
@auth
    <x-booking :hall="$hall" :bookings="$bookings" :hallPrice="$hallPrice"></x-booking>
    @if(Auth::user()->id_role == 2)
        <div class="modal fade" id="warning" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Modalwarning">{{$hall->name_hall}} (Площадь {{$hall->area_hall}}
                            м²)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <strong>Вы точно хотите забронировать место в своем зале?</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                        <button type="button" class="btn btn-primary" id="apply">Да</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endauth
<script>
    let isWarningConfirmed = false;

    document.getElementById('apply').addEventListener('click', function () {
        if (!isWarningConfirmed) {
            isWarningConfirmed = true;  // Устанавливаем флаг после первого нажатия
            $('#warning').modal('hide');
        }
    });

    // Открытие окна бронирования только при первом подтверждении
    $('#warning').on('hidden.bs.modal', function () {
        if (isWarningConfirmed) {
            $('#booking').modal('show');
        }
    });

    // Сброс состояния при закрытии модального окна бронирования
    $('#booking').on('hidden.bs.modal', function () {
        isWarningConfirmed = false;  // Сбрасываем флаг
    });

    // При закрытии окна бронирования через кнопку или по клику вне окна
    $('#booking .close').on('click', function () {
        $('#booking').modal('hide');
        isWarningConfirmed = false;  // Сбрасываем флаг
    });
</script>

<script>
    $(document).ready(function () {
        $('#checkbox').change(function () {
            var itemId = $(this).data('item-id');
            var url = $(this).is(':checked') ? '{{ route("favorite.add") }}' : '{{ route("favorite.remove") }}';
            var method = $(this).is(':checked') ? 'POST' : 'DELETE';

            $.ajax({
                url: url,
                type: method,
                data: {
                    item_id: itemId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log(response.status);
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        const mapElement = document.getElementById('map');

        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                loadMap();
                observer.disconnect();
            }
        }, {threshold: 0.1});

        observer.observe(mapElement);
    });

    function loadMap() {
        fetch('/get_coordinates', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({address: "{{$hall->address_hall}}"})
        })
            .then(response => response.json())
            .then(data => {
                if (data.coordinates) {
                    ymaps3.ready.then(function () {
                        const {YMap, YMapDefaultSchemeLayer, YMapDefaultFeaturesLayer} = ymaps3;

                        const map = new YMap(document.getElementById('map'), {
                            location: {
                                center: [parseFloat(data.coordinates.latitude), parseFloat(data.coordinates.longitude)],
                                zoom: 18
                            }
                        }, [
                            new YMapDefaultSchemeLayer(),
                            new YMapDefaultFeaturesLayer()
                        ]);

                        const markerElement = document.createElement('div');
                        markerElement.className = 'marker-class';
                        markerElement.setAttribute('data-tooltip', '{{$hall->address_hall}}');

                        const marker = new ymaps3.YMapMarker(
                            {
                                coordinates: [parseFloat(data.coordinates.latitude), parseFloat(data.coordinates.longitude)],
                                draggable: false,
                                mapFollowsOnDrag: true
                            },
                            markerElement
                        );

                        map.addChild(marker);
                    });
                } else {
                    console.error('Coordinates not found');
                }
            })
            .catch(error => {
                console.error('Error fetching coordinates:', error);
            });
    }
</script>

