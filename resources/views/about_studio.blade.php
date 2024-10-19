<x-layout>
    <script
        src="https://api-maps.yandex.ru/v3/?apikey={{config('services.yandex_geocoding.api_key')}}&lang=ru_RU"></script>
    <style>
        .studio_halls {
            width: 80%;
            display: flex;
            margin: 0 auto;
            flex-wrap: wrap;
        }

        .lower-text h3 {
            text-align: left;
            font-size: 18px;
            color: black;
        }
    </style>
    <!-- Banner Section -->
    <section class="page-banner">
        <div class="image-layer"
             style="background-image:url('/storage/banner_studio/{{$studio_info->banner_studio}}');"></div>
        <div class="banner-bottom-pattern"></div>

        <div class="banner-inner">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <h1>Студия {{$studio_info->name_studio}}</h1>
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
                            <h2>{{$studio_info->name_studio}}</h2>
                        </div>
                        <div class="text">{!! nl2br(e($studio_info->description_studio)) !!}</div>
                    </div>
                </div>
                <!--Image Column-->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner">
                        <span class="dotted-pattern dotted-pattern-10"></span>
                        <div class="image-box clearfix">
                            <figure class="image wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms"><img
                                    src="/storage/photo_studios/{{$studio_info->photo_studio}}"
                                    alt="{{$studio_info->photo_studio}}" title="{{$studio_info->name_studio}}">
                            </figure>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Facts Section-->
    <div class="auto-container studio_halls">
        @forelse($studio_info->halls as $hall)
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
    </div>
    <div class="auto-container centered" style="margin-top: 50px;">
        <h2>Контакты студии</h2>
        <div class="sec-title d-flex" style="position: relative;">
            <div id="map" style="width: 100%; height: 450px;"></div>
            <div class="contact-info">
                <h5>{{$studio_info->adress_studio}}</h5>
                <p>Телефон: <a href="tel:{{$studio_info->phone_studio}}">{{$studio_info->phone_studio}}</a></p>
                <p>Почта: <a href="mailto:{{$studio_info->email_studio}}">{{$studio_info->email_studio}}</a></p>
            </div>
        </div>
    </div>

</x-layout>
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
            body: JSON.stringify({address: "{{$studio_info->adress_studio}}"})
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
                        markerElement.setAttribute('data-tooltip', '{{$studio_info->adress_studio}}');

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


