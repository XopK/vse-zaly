<x-layout>
    <style>
        form {
            box-shadow: none;

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
                                <div class="form-group">
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
                                <div class="form-group">
                                    <label>Цена в будни</label>
                                    <input type="number" min="0" name="price_weekday" class="form-control"
                                           value="{{$hall->price_weekday}}" required>
                                </div>
                                @error('price_weekday')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label>Цена в выходные</label>
                                    <input type="number" min="0" name="price_weekend" class="form-control"
                                           value="{{$hall->price_weekend}}" required>
                                </div>
                                @error('price_weekend')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label>Время для повышения цены (вечер)</label>
                                    <input type="time" name="time_evening" class="form-control"
                                           value="{{$hall->time_evening}}" required>
                                </div>
                                @error('time_evening')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label>Цена вечером</label>
                                    <input type="number" min="0" name="price_evening" class="form-control"
                                           value="{{$hall->price_evening}}" required>
                                </div>
                                @error('price_evening')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label>Цена в выходные/вечером</label>
                                    <input type="number" min="0" name="max_price" class="form-control"
                                           value="{{$hall->max_price}}" required>
                                </div>
                                @error('max_price')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label>Скидка для студии (сколько будем отнимать от текущих цен)</label>
                                    <input type="number" min="0" name="price_for_studio" class="form-control"
                                           value="{{$hall->price_for_studio}}" required>
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
                                    <label>Надбавка цены за 2 до 3 человек</label>
                                    <input type="number" min="0" name="price_for_two" class="form-control"
                                           value="{{$hall->price_for_two}}" required>
                                </div>
                                @error('price_for_two')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label>Надбавка цены за 4 до 6 человек</label>
                                    <input type="number" min="0" name="price_for_four" class="form-control"
                                           value="{{$hall->price_for_four}}" required>
                                </div>
                                @error('price_for_four')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label>Надбавка цены за 7 до 9 человек</label>
                                    <input type="number" min="0" name="price_for_seven" class="form-control"
                                           value="{{$hall->price_for_seven}}" required>
                                </div>
                                @error('price_for_seven')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label>Надбавка цены за 10 и более человек</label>
                                    <input type="number" min="0" name="price_for_nine" class="form-control"
                                           value="{{$hall->price_for_nine}}" required>
                                </div>
                                @error('price_for_nine')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn-style-one btn-block"><span
                                            class="btn-title">Изменить</span></button>
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
                        {{-- <li><span class="icon flaticon-tv"></span> Telivision</li> --}}
                        <li><span class="icon flaticon-wifi"></span> Wi-Fi</li>
                        <li><span class="icon flaticon-coffee-cup"></span> Кофе</li>
                        <li><span class="icon flaticon-wine-glass"></span> Мини бар</li>
                        {{-- <li><span class="icon flaticon-dumbbell"></span> Gymnasium</li> --}}
                    </ul>
                </div>
            </div>

            <div class="lower-box">
                <div class="w-25 mb-3">
                    <button type="submit" data-toggle="modal" data-target="#photoadd"
                            class="theme-btn btn-style-one btn-block"><span
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
<x-booking_studio :hall="$hall" :bookings="$bookings"></x-booking_studio>
<script src="/js/rangeStep.js"></script>
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
                url: '/update_privew/' + photoId,
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

