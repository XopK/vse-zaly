<x-layout>

    <!-- Banner Section -->
    <section class="page-banner">
        <div class="image-layer" style="background-image: url('/images/background/studios.jpg');"></div>
        <div class="banner-bottom-pattern"></div>

        <div class="banner-inner">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <h1>Студии с которыми мы работаем</h1>
                </div>
            </div>
        </div>
    </section>
    <!--End Banner Section -->

    <!--Team Section-->
    <section class="team-section">
        <div class="circles-two">
            <div class="c-1"></div>
            <div class="c-2"></div>
        </div>
        <span class="dotted-pattern dotted-pattern-3"></span>
        <span class="tri-pattern tri-pattern-3"></span>
        <div class="auto-container">
            <div class="row clearfix">

                @forelse($Studios as $studio)
                    <div class="team-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms"
                         data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><a
                                        href="/about_studio/{{$studio->id}}-{{Str::slug($studio->name_studio)}}"><img
                                            src="/storage/photo_studios/{{$studio->photo_studio}}"
                                            alt="studiologo" title="{{$studio->name_studio}}"></a>
                                </figure>
                            </div>
                            <div class="info-box">
                                <div class="info-inner">
                                    <h4>Студия {{$studio->name_studio}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h1>Отсуствуют студии</h1>
                @endforelse

            </div>
        </div>
    </section>

</x-layout>
