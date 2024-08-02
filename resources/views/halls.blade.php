<x-layout>

    <!--Rooms Section-->

    <section class="rooms-section" style="margin-top: 40px">
        <!-- <a href="/test">test</a> -->
        <div class="auto-container">
            <!--Filters Section-->
            <div class="filters-section filters-container">
                <div class="form-box default-form filter-form wow fadeInUp" data-wow-delay="0ms"
                     data-wow-duration="1500ms">
                    <form class="form_filter" action="">
                        <div class="form-group">
                            <label for="title">Поиск по названию</label>
                            <input id="title" class="form-control" type="text" style="height: 52px; padding: 10px 20px">
                        </div>
                        <label for="areaRange">Площадь зала </label>
                        <div class="d-flex">
                            <input type="number" class="form-control mr-2" id="areaMin" placeholder="(м²)" min="0"
                                   max="500" style="height: 52px; padding: 10px 20px">
                            <input type="range" class="form-control-range mx-2" id="areaRangeMin" min="0" max="500"
                                   step="1">
                            <input type="range" class="form-control-range mx-2" id="areaRangeMax" min="0" max="500"
                                   step="1">
                            <input type="number" class="form-control ml-2" id="areaMax" placeholder="Max" min="0"
                                   max="500">
                        </div>
                    </form>
                </div>
            </div>
            <div class="row clearfix">
                @forelse($halls as $hall)
                    <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms"
                         data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><a href="/hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}"><img
                                            src="/storage/photo_halls/{{$hall->preview_hall}}"
                                            alt="{{$hall->preview_hall}}"
                                            title="{{$hall->name_hall}}"></a></figure>
                            </div>
                            <div class="lower-box">
                                <h4>{{$hall->name_hall}}</h4>
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

                                <div class="text text-truncate">{{$hall->description_hall}}
                                </div>
                                <div class="link-box"><a href="/hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}"
                                                         class="theme-btn btn-style-three"><span
                                            class="btn-title">Просмотреть</span></a></div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
    </section>
</x-layout>
