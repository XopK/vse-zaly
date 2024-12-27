@forelse($halls as $hall)
    <div class="room-block-two fix-block col-lg-4 col-md-6 col-sm-12 hall-item"
         data-id="{{ $hall->id }}"
         data-price="{{ $hall->max_price }}"
         data-area="{{ $hall->area_hall }}"
         data-name="{{ Str::lower($hall->name_hall) }}"
         data-studio="{{ Str::slug($hall->studio->name_studio) }}"
         data-address="{{ strtolower($hall->address_hall) }}">
        <div class="inner-box">
            <div class="image-box filter-image-box">
                <figure class="image image-filter">
                    <a href="/hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}"><img
                            src="/storage/photo_halls/{{$hall->preview_hall}}"
                            alt="{{$hall->preview_hall}}"
                            title="{{$hall->name_hall}}"></a>
                </figure>
            </div>
            <div class="lower-box">
                <h4>{{$hall->name_hall}}</h4>
                <div class="pricing clearfix">
                    <div class="price">Площадь <span>{{$hall->area_hall}} м²</span></div>
                </div>
                <div class="text text-truncate">{{$hall->description_hall}}</div>
                <div class="link-box">
                    <a href="/hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}"
                       class="theme-btn btn-style-three"><span
                            class="btn-title">Просмотреть</span></a>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-warning" role="alert" style="text-align: center; width: 80%; margin: 0 auto;">
        Нет результатов
    </div>
@endforelse

