<x-layout>
    <style>
        form {
            box-shadow: none;
        }

        .custom-input {
            width: 60px;
        }

        .btn-group-icon button {
            margin-left: 5px;
        }

        .count-k {
            position: relative;
            top: 12px;
        }

        .close {
            position: relative;
            top: 10px;
        }

        @media (max-width: 768px) {
            .custom-input {
                width: 50px;
            }

            .price-block {
                position: relative;
            }

            .count-k {
                top: 0;
            }

            .price-block .close {
                position: absolute;
                top: 5px;
                right: 5px;
            }
        }
    </style>
    <head>
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
    </head>
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
                    <h2>
                        {{$hall->name_hall}}
                    </h2>
                    <div class="pricing clearfix">
                        <div class="price">Площадь
                            <span>
                                {{$hall->area_hall}} м²
                            </span>
                        </div>

                    </div>
                    <div class="text">
                        <p>{{$hall->description_hall}}</p>
                    </div>
                    <div class="text">
                        <p><i class="fa fa-map-marker" aria-hidden="true"
                              style="margin-right: 10px"></i>{{$hall->address_hall}}</p>
                    </div>
                    <div class="col-lg-3 mb-3" style="padding-left: 0">
                        <button type="button" class="theme-btn btn-style-one btn-block" data-toggle="modal"
                                data-target="#booking"><span
                                class="btn-title">Зарезервировать</span></button>
                    </div>
                </div>
            </div>

            <div class="details-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                <div class="details-inner">
                    <h3>Редактирование зала</h3>
                    <section class="studio_form">
                        <div class="col-sm-12 pt-2 pb-2">
                            <form method="post" action="{{ route('edit_hall', ['hall' => $hall->id]) }} "
                                  id="editStudio"
                                  enctype="multipart/form-data">
                                @csrf
                                @if (session('error_hall'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ session('error_hall') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session('success_hall'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ session('success_hall') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label class="font-weight-bold">Название зала<span
                                            class="text-danger"></span></label>
                                    <input value="{{ $hall->name_hall }}" type="text" name="hall_name"
                                           id="hall_name" class="form-control" required>
                                </div>
                                @error('hall_name')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label class="font-weight-bold">Площадь зала <span
                                            class="text-danger"></span></label>
                                    <input type="number" class="form-control" min="0" name="hall_area"
                                           value="{{ $hall->area_hall }}" id="hall_area"
                                           required>
                                </div>
                                @error('hall_area')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label class="font-weight-bold">Расположение зала <span
                                            class="text-danger"></span></label>
                                    <input type="text" name="address_hall" class="form-control"
                                           value="{{$hall->address_hall}}" required>
                                </div>
                                @error('price_for_studio')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label class="font-weight-bold">Описание зала <span
                                            class="text-danger"></span></label>
                                    <textarea class="form-control" name="hall_description" id="hall_description"
                                    >{{ $hall->description_hall }}</textarea>
                                </div>
                                @error('hall_description')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label class="font-weight-bold">Правила зала <span
                                            class="text-danger"></span></label>
                                    <textarea class="form-control" name="hall_terms"
                                              id="hall_terms">{{ $hall->rule_hall }}</textarea>
                                </div>
                                @error('hall_terms')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group" style="margin-left: 20px">
                                    @forelse($allFeatures as $allFeature)
                                        <div class="feature-item my-3">
                                            <input name="features[]"
                                                   {{ $hall->features->contains('id', $allFeature->id) ? 'checked' : '' }} class="form-check-input"
                                                   type="checkbox"
                                                   value="{{$allFeature->id}}"
                                                   id="defaultCheck{{ $loop->index }}">
                                            <label class="form-check-label" for="defaultCheck{{ $loop->index }}">
                                                {{$allFeature->title_feature}}
                                                <img src="/images/features/{{$allFeature->photo_feature}}"
                                                     alt="Feature Image"
                                                     style="margin-left: 10px;">
                                            </label>
                                        </div>
                                    @empty
                                        <p>Нет доступных удобств.</p>
                                    @endforelse
                                </div>
                                <div class="form-group" style="width: 50%">
                                    <label>Шаг бронирования: <span id="step_booking_display"
                                                                   class="font-weight-bold">1 час</span></label>
                                    <input type="range" id="step_booking_slider" name="step_booking"
                                           class="form-control-range mr-3"
                                           min="0.5" max="3" step="0.5" value="{{ $hall->step_booking }}">
                                </div>
                                @error('step_booking')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label>Время открытия</label>
                                    <input type="time" name="start_time" class="form-control"
                                           value="{{$hall->start_time}}" required>
                                </div>
                                @error('start_time')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label>Время закрытия</label>
                                    <input type="time" name="end_time" class="form-control"
                                           value="{{$hall->end_time}}" required>
                                </div>
                                @error('end_time')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="contain-price">
                                    <div class="mb-3">
                                        <div class="send-btn">
                                            <button id="duplicate-block" type="button" class="theme-btn btn-style-one">
                                                <span class="btn-title" style="padding: 5px 15px">Добавить блок</span>
                                            </button>
                                        </div>
                                    </div>
                                    @foreach($hall_price as $key=>$price)
                                        <input type="hidden" name="id_price[]" value="{{$price->id}}">
                                        <div
                                            class="form-row align-items-center px-1 mb-4 price-block {{ $key > 0 ? '' : 'originalblock  ' }}"
                                            id="price-block-{{$price->id}}">
                                            <div class="d-flex align-items-center count-k">
                                                <div class="px-1">
                                                    <span>От</span>
                                                </div>
                                                <div class="px-1">
                                                    <input type="number" min="0" name="min_people[]"
                                                           class="form-control custom-input"
                                                           value="{{$price->min_people}}" {{ $key > 0 ? '' : 'readonly' }}>
                                                </div>
                                                <div class="px-1">
                                                    <span>до</span>
                                                </div>
                                                <div class="px-1">
                                                    <input type="number" min="0" name="max_people[]"
                                                           class="form-control custom-input"
                                                           value="{{$price->max_people}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 mt-2 mt-md-0">
                                                <div class="form-row">
                                                    <div class="col-6 col-sm col-lg-3 mb-2" style="padding-left: 0">
                                                        <label for="weekday_price_{{$loop->index}}"
                                                               style="font-size: 14px;">Будни</label>
                                                        <input type="number" min="0" name="weekday_price[]"
                                                               class="form-control" id="weekday_price_{{$loop->index}}"
                                                               placeholder="Будни" value="{{$price->weekday_price}}">
                                                    </div>
                                                    <div class="col-6 col-sm col-lg-3 mb-2">
                                                        <label for="weekday_evening_price_{{$loop->index}}"
                                                               style="font-size: 14px;">Будни/Вечер</label>
                                                        <input type="number" min="0" name="weekday_evening_price[]"
                                                               class="form-control"
                                                               id="weekday_evening_price_{{$loop->index}}"
                                                               placeholder="Будни/Вечер"
                                                               value="{{$price->weekday_evening_price}}">
                                                    </div>
                                                    <div class="col-6 col-sm col-lg-3" style="padding-left: 0">
                                                        <label for="weekend_price_{{$loop->index}}"
                                                               style="font-size: 14px;">Выходные</label>
                                                        <input type="number" min="0" name="weekend_price[]"
                                                               class="form-control" id="weekend_price_{{$loop->index}}"
                                                               placeholder="Выходные" value="{{$price->weekend_price}}">
                                                    </div>
                                                    <div class="col-6 col-sm col-lg-3">
                                                        <label for="weekend_evening_price_{{$loop->index}}"
                                                               style="font-size: 14px; white-space: nowrap;">Выходные/Вечер</label>
                                                        <input type="number" min="0" name="weekend_evening_price[]"
                                                               class="form-control"
                                                               id="weekend_evening_price_{{$loop->index}}"
                                                               placeholder="Выходные/Вечер"
                                                               value="{{$price->weekend_evening_price}}">
                                                    </div>
                                                </div>
                                            </div>
                                            @if($key > 0)
                                                <button type="button" class="close px-2 delete-price"
                                                        data-id="{{$price->id}}"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach

                                    <div id="cloned-blocks"></div>
                                    <div class="form-group">
                                        <button type="submit" class="theme-btn btn-style-one btn-block"><span
                                                class="btn-title">Изменить</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>

            <div class="details-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                <div class="details-inner">
                    <h3>Зал предоставляет:</h3>
                    <div class="text">Правила: {{$hall->rule_hall}}</div>
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
                <div class="col-lg-3 p-0">
                    <button type="submit" data-toggle="modal" data-target="#photoadd"
                            class="theme-btn btn-style-one btn-block mb-3"><span
                            class="btn-title">Добавить фотографии +</span></button>
                </div>
                <div class="row clearfix">
                    @forelse($hall->photo_halls as $photo)
                        <div class="image-block col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms"
                             data-wow-duration="1500ms">
                            <figure class="image"><a href="/storage/photo_halls/{{$photo->photo_hall}}"
                                                     class="lightbox-image"><img
                                        src="/storage/photo_halls/{{$photo->photo_hall}}"
                                        alt="{{$photo->photo_hall}}"></a>
                                <button type="button" title="Удалить" class="close btn-cls" aria-label="Close"
                                        style="background-color: red; width: 40px; height: 40px; color: white; border-radius: 50%; position: absolute; right: 5px; top: 5px; padding-bottom: 3px"
                                        data-record-id="{{ $photo->id }}">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                                <button type="button" title="Установить как превью" class="close btn-set"
                                        style="background-color: #5e5eff; width: 40px; height: 40px; color: white; border-radius: 50%; position: absolute; right: 50px; top: 5px; padding-top: 4px"
                                        data-photo-id="{{ $photo->id }}" data-name-photo="{{$photo->photo_hall}}">
                                    <span class="material-symbols-outlined">visibility</span>
                                </button>

                            </figure>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </section>

</x-layout>
<x-booking_studio :hall="$hall" :bookings="$bookings" :hall_price="$hall_price"></x-booking_studio>
<script src="/js/rangeStep.js"></script>
<script>
    let blockCount = {{ count($hall_price) }};
</script>
<script src="/js/priceHallEdit.js"></script>
<script>
    $(document).ready(function () {
        $('.btn-cls').on('click', function () {
            var button = $(this);
            var recordId = button.data('record-id');
            var imageBlock = button.closest('.image-block');


            $.ajax({
                url: '/delete_photo/' + recordId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        imageBlock.remove();
                    } else {
                        console.log('Ошибка при удалении записи.');
                    }
                },
                error: function () {
                    console.log('Ошибка при удалении записи.');
                }
            });
        });

        $('.btn-set').on('click', function () {
            var button = $(this);
            var photoId = button.data('photo-id');
            var backgroundImage = $('.image-layer').css('background-image');
            var newPhoto = button.data('name-photo');

            $.ajax({
                url: '/update_preview/' + photoId,
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    if (response.success) {
                        $('.image-layer').css('background-image', 'url(/storage/photo_halls/' + newPhoto + ')');
                    } else {
                        console.log('Ошибка обновления');
                    }
                },
                error: function () {
                    console.log('Ошибка обновления');
                }
            });
        });

        $('.delete-price').on('click', function () {
            var id = $(this).data('id');
            var url = '/delete_hall/price/' + id;
            var block = $('#price-block-' + id);


            $.ajax({
                url: url, type: 'DELETE', data: {
                    _token: '{{ csrf_token() }}'
                }, success: function (response) {
                    if (response.success) {
                        block.fadeOut(400, function () { // Анимация исчезновения
                            block.remove(); // Удаление элемента после завершения анимации
                        });
                    } else {
                        console.log('Произошла ошибка при удалении.');
                    }
                }, error: function () {
                    console.log('Не удалось удалить запись.');
                }
            });

        });
    });
</script>
<div class="modal fade" id="photoadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавление фотографий</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="/my_hall/{{$hall->id}}/add_photo">
                    @csrf
                    <div class="col-lg-12 ">
                        <div class="form-group photo">
                            <label>Фотографии зала</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="photo_hall[]" accept="image/*"
                                           id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" multiple>
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
                    <div class="col-lg-12">
                        <div class="send-btn">
                            <button type="submit" class="theme-btn btn-style-one"><span
                                    class="btn-title">Добавить</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelector('.custom-file-input').addEventListener('change', function (event) {
        var input = event.target;
        var label = input.nextElementSibling;

        if (input.files.length > 0) {
            var fileNames = Array.from(input.files).map(file => file.name).join(', ');
            label.textContent = fileNames;
        } else {
            label.textContent = 'Выбрать файл';
        }
    });
</script>

