<x-layout>
    <style>
        .hall_add {
            width: 80%;
            margin: 30px auto;
        }

        .custom-input {
            width: 55px;
        }


        .btn-group-icon button {
            margin-left: 5px;
        }

        .form-row {
            align-items: center;
            padding-right: 0.5rem;
            padding-left: 0.5rem;
        }

        @media (max-width: 768px) {
            .custom-input {
                width: 50px;
            }

            #price-block {
                position: relative;
            }

            #price-block .close {
                position: absolute;
                top: 70px;
                right: 25px;
            }
        }
    </style>
    <div class="hall_add">

        <div class="my-address contact-2">
            <h3 class="heading-3">Добавить новый зал</h3>
            <form action="/">

            </form>
            <form action="{{ route('create_hall') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (session('error_create'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error_create') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('success_create'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success_create') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="form-group name">
                            <label>Название зала</label>
                            <input type="text" name="name_hall" value="{{old('name_hall')}}" class="form-control">
                        </div>
                        @error('name_hall')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-12 ">
                        <div class="form-group number">
                            <label>Площадь зала м²</label>
                            <input type="number" name="area_hall" min="0" value="{{old('area_hall')}}"
                                   class="form-control">
                        </div>
                        @error('area_hall')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-12 ">
                        <div class="form-group number">
                            <label>Расположение зала</label>
                            <input type="text" name="location_hall" value="{{old('location_hall')}}"
                                   class="form-control"
                                   placeholder="г.Уфа ул.Коммунистическая 46/1">
                        </div>
                        @error('location_hall')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-12 ">
                        <div class="form-group subject">
                            <label>Описание зала</label>
                            <textarea id="description_hall" rows="7" placeholder="Краткое описание зала"
                                      name="description_hall"
                                      class="form-control">{{old('description_hall')}}</textarea>
                        </div>
                        @error('description_hall')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-12 ">
                        <div class="form-group subject">
                            <label>Правила зала</label>
                            <textarea id="terms_hall" name="terms_hall" class="form-control"
                                      placeholder="Опишите что нельзя делать людям в зале, пропишите ваши штрафы и т.д.">{{old('terms_hall')}}</textarea>
                        </div>
                        @error('terms_hall')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-12 ">
                        <div class="form-group subject">
                            <h5>Удобства зала</h5>
                            <div class="form-check">
                                @forelse($features as $feature)
                                    <div class="feature-item my-3">
                                        <input name="features[]" class="form-check-input" type="checkbox"
                                               value="{{ $feature->id }}" id="defaultCheck{{ $loop->index }}">
                                        <label class="form-check-label" for="defaultCheck{{ $loop->index }}">
                                            {{ $feature->title_feature }}
                                            <img src="/images/features/{{ $feature->photo_feature }}"
                                                 alt="Feature Image" style="margin-left: 10px;">
                                        </label>
                                    </div>
                                @empty
                                    <p>Нет доступных удобств.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-12">
                        <div class="form-group subject">
                            <label>Шаг бронирования: <span id="step_booking_display" class="font-weight-bold">1
                                    час</span></label>
                            <input type="range" id="step_booking_slider" name="step_booking"
                                   class="form-control-range mr-3" min="0.5" max="3" step="0.5"
                                   value="1">
                        </div>
                        @error('step_booking')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-12 d-flex">
                        <div class="col-lg-6" style="padding-left: 0">
                            <div class="form-group subject">
                                <label>Время открытия</label>
                                <input type="time" min="0" name="start_time" class="form-control"
                                       value="{{old('start_time')}}">
                            </div>
                            @error('start_time')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror
                        </div>
                        <div class="col-lg-6" style="padding-right: 0">
                            <div class="form-group subject">
                                <label>Время закрытия</label>
                                <input type="time" min="0" name="end_time" class="form-control"
                                       value="{{old('end_time')}}">
                            </div>
                            @error('end_time')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group subject">
                            <label>Время вечера</label>
                            <input type="time" min="0" name="time_evening" value="18:00" class="form-control">
                        </div>
                        @error('time_evening')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror
                    </div>
                    <div class="col-lg-12 contain-price">
                        <p>Вы указываете цену за шаг брони!!!</p>
                        <!-- Блок, который будет клонироваться -->
                        <div class="form-row align-items-center mb-4" id="price-block">
                            <!-- Часть с количеством людей -->
                            <div class="px-1">
                                <span>От</span>
                            </div>
                            <div class="px-1">
                                <input id="numberone" type="number" min="0" name="min_people[]"
                                       class="form-control custom-input" value="1" readonly>
                            </div>
                            <div class="px-1">
                                <span>до</span>
                            </div>
                            <div class="px-1">
                                <input type="number" min="0" name="max_people[]"
                                       class="form-control custom-input">
                            </div>
                            <div class="px-1">
                                <span>чел.</span>
                            </div>

                            <!-- Время: Будни, Вечер и т.д. -->
                            <div class="col-sm-12 col-md-6 mt-2 mt-md-0">
                                <div class="form-row">
                                    <div class="col-5 col-sm" style="padding-left: 0">
                                        <input type="number" min="0" name="weekday_price[]"
                                               class="form-control" placeholder="Будни/день">
                                    </div>
                                    <div class="col-5 col-sm">
                                        <input type="number" min="0" name="weekday_evening_price[]"
                                               class="form-control" placeholder="Будни/вечер">
                                    </div>
                                    <div class="col-5 col-sm" style="padding-left: 0">
                                        <input type="number" min="0" name="weekend_price[]"
                                               class="form-control" placeholder="Вых/день">
                                    </div>
                                    <div class="col-5 col-sm">
                                        <input type="number" min="0" name="weekend_evening_price[]"
                                               class="form-control" placeholder="Вых/вечер">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="cloned-blocks"></div>
                        <div class="mb-3">
                            <div class="send-btn">
                                <button id="duplicate-block" type="button" class="theme-btn btn-style-one">
                                    <span class="btn-title" style="padding: 5px 15px">Добавить блок</span>
                                </button>
                            </div>
                        </div>
                        @php
                            $fields = [
                                'max_people',
                                'min_people',
                                'weekday_price',
                                'weekday_evening_price',
                                'weekend_price',
                                'weekend_evening_price',
                            ];
                            $hasErrors = false;
                            foreach ($fields as $field) {
                                if ($errors->has($field)) {
                                    $hasErrors = true;
                                    break;
                                }
                                for ($i = 0; $i < count(old($field, [])); $i++) {
                                    if ($errors->has("$field.$i")) {
                                        $hasErrors = true;
                                        break 2;
                                    }
                                }
                            }
                        @endphp
                        @if ($hasErrors)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Пожалуйста, исправьте ошибки в заполнение цен.</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group photo">
                            <label>Фотографии зала</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="photo_hall[]"
                                           accept="image/*" id="inputGroupFile01"
                                           aria-describedby="inputGroupFileAddon01" multiple>
                                    <label class="custom-file-label" for="inputGroupFile01">Выберите
                                        файл/ы</label>
                                </div>
                            </div>
                        </div>

                        @error('photo_hall.*')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror
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
                </div>
            </form>
        </div>

    </div>

    <!--Rooms Section-->
    <section class="rooms-section" style="margin-top: 20px">
        <div class="auto-container">
            <h3>Ваши залы</h3>
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
                                <div class="link-box mb-3"><a
                                        href="/my_hall/{{ $hall->id }}-{{ Str::slug($hall->name_hall) }}"
                                        class="theme-btn btn-style-three"><span class="btn-title">Редактировать
                                            зал</span></a></div>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-danger" style="width: 100%; padding: 15px 0"
                                            data-toggle="modal" data-target="#warning" data-id="{{ $hall->id }}"
                                            data-name="{{ $hall->name_hall }}">
                                        Удалить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning" role="alert" style="width: 100%">
                        <strong>Залы отсутствуют!</strong><br>
                        К сожалению, у вас нет доступных залов. Пожалуйста, добавьте новый зал или свяжитесь с
                        администрацией для получения помощи.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-layout>
<script src="/js/rangeStep.js"></script>
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
<script src="/js/priceHall.js"></script>
<div class="modal fade" id="warning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Удаление зала</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <strong>Вы уверены, что хотите удалить зал "<span id="hallName"></span>"?</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#warning').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var hallName = button.data('name'); // Extract hall name from data-* attributes
        var hallId = button.data('id'); // Extract hall id from data-* attributes

        // Update the modal's content.
        var modal = $(this);
        modal.find('#hallName').text(hallName);
        modal.find('#deleteForm').attr('action', '/delete_hall/' + hallId);
    });
</script>
