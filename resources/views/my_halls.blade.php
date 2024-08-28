<x-layout>
    <style>
        .hall_add {
            width: 80%;
            margin: 150px auto;
        }
    </style>
    <div class="hall_add">

        <div class="my-address contact-2">
            <h3 class="heading-3">Добавить новый зал</h3>
            <form action="{{route('create_hall')}}" method="POST" enctype="multipart/form-data">
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
                            <input type="text" name="name_hall" class="form-control">
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
                            <label>Площадь зала</label>
                            <input type="number" name="area_hall" min="0" class="form-control">
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
                            <input type="text" name="location_hall" class="form-control"
                                   placeholder="г.Уфа ул.Коммунистическая 46/1" required>
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
                            <textarea id="description_hall" rows="7" name="description_hall"
                                      class="form-control"></textarea>
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
                                      placeholder="Опишите что нельзя делать людям в зале, пропишите ваши штрафы и т.д."></textarea>
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
                    <div class="col-lg-5 col-12">
                        <div class="form-group subject">
                            <label>Шаг бронирования: <span id="step_booking_display"
                                                           class="font-weight-bold">1 час</span></label>
                            <input type="range" id="step_booking_slider" name="step_booking"
                                   class="form-control-range mr-3"
                                   min="0.5" max="3" step="0.5" value="1">
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
                                <input type="time" min="0" name="start_time" class="form-control" required>
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
                                <input type="time" min="0" name="end_time" class="form-control" required>
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
                    <div class="col-lg-12 ">
                        <div class="form-group subject">
                            <label>Цена в будни</label>
                            <input type="number" min="0" name="price_weekday" class="form-control" required>
                        </div>
                        @error('price_weekday')
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
                            <label>Цена в выходные</label>
                            <input type="number" min="0" name="price_weekend" class="form-control" required>
                        </div>
                        @error('price_weekend')
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
                            <label>Время для повышения цены (вечер)</label>
                            <input type="time" name="time_evening" class="form-control">
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

                    <div class="col-lg-12 ">
                        <div class="form-group subject">
                            <label>Цена вечером</label>
                            <input type="number" min="0" name="price_evening" class="form-control">
                        </div>
                        @error('price_evening')
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
                            <label>Цена в выходные/вечером</label>
                            <input type="number" min="0" name="max_price" class="form-control">
                        </div>
                        @error('max_price')
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
                            <label>Скидка для студии (сколько будем отнимать от текущих цен)</label>
                            <input type="number" min="0" name="price_for_studio" class="form-control">
                        </div>
                        @error('price_for_studio')
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
                            <label>Надбавка цены за 2 до 3 человек</label>
                            <input type="number" min="0" name="price_for_two" class="form-control">
                        </div>
                        @error('price_for_two')
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
                            <label>Надбавка цены за 4 до 6 человек</label>
                            <input type="number" min="0" name="price_for_four" class="form-control">
                        </div>
                        @error('price_for_four')
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
                            <label>Надбавка цены за 7 до 9 человек</label>
                            <input type="number" min="0" name="price_for_seven" class="form-control">
                        </div>
                        @error('price_for_seven')
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
                            <label>Надбавка цены за 10 и более человек</label>
                            <input type="number" min="0" name="price_for_nine" class="form-control">
                        </div>
                        @error('price_for_nine')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror
                    </div>

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
                                        href="/my_hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}"><img
                                            src="/storage/photo_halls/{{$hall->preview_hall}}"
                                            alt="{{$hall->preview_hall}}" title="{{$hall->name_hall}}"></a></figure>
                            </div>
                            <div class="lower-box">
                                <h4>{{$hall->name_hall}}</h4>
                                <div class="pricing clearfix">
                                    <div class="price">Площадь <span>{{$hall->area_hall}} м²</span></div>
                                    <div class="rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    </div>
                                </div>

                                <div class="text text-truncate">{{$hall->description_hall}}</div>
                                <div class="link-box mb-3"><a
                                        href="/my_hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}"
                                        class="theme-btn btn-style-three"><span
                                            class="btn-title">Редактировать зал</span></a></div>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-danger" style="width: 100%; padding: 15px 0"
                                            data-toggle="modal"
                                            data-target="#warning" data-id="{{$hall->id}}"
                                            data-name="{{$hall->name_hall}}">
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
</x-layout>
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






