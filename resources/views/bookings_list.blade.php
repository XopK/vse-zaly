<x-layout>
    <section class="rooms-section" style="padding: 50px 0">
        <div class="auto-container">
            <h3>Залы студии</h3>
            <div class="row clearfix">
                @forelse($halls as $hall)
                    <div class="room-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms"
                         data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><a
                                        href="/my_hall/{{ $hall->id }}-{{ Str::slug($hall->name_hall) }}"><img
                                            src="/storage/photo_halls/{{ $hall->preview_hall }}"
                                            alt="{{ $hall->preview_hall }}" title="{{ $hall->name_hall }}"></a>
                                </figure>
                            </div>
                            <div class="lower-box">
                                <h4>{{ $hall->name_hall }}</h4>
                                <div class="pricing clearfix">
                                    <div class="price">Площадь <span>{{ $hall->area_hall }} м²</span></div>

                                </div>

                                <div class="text text-truncate">{{ $hall->description_hall }}</div>
                                <div class="link-box mb-3"><a href="javascript:void(0);"
                                                              data-id="{{ $hall->id }}"
                                                              data-name="{{ $hall->name_hall }}"
                                                              data-area="{{ $hall->area_hall }}"
                                                              class="theme-btn btn-style-three openModalButton"><span
                                            class="btn-title">Просмотреть брони</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning" role="alert" style="width: 100%">
                        <strong>Залы отсутствуют!</strong>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-layout>
<x-booking_staff/>
