@forelse($halls as $hall)
    <div class="room-block-two fix-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms"
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
    <div class="cd-fail-message">No results found</div>
@endforelse
