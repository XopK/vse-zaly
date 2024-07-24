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
                            <input type="number" name="area_hall" class="form-control">
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
                            <textarea id="description_hall" name="description_hall" class="form-control"></textarea>
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
                    {{--                    <h4 style="margin-left: 15px;">Что есть в зале</h4>--}}
                    {{--                    <div class="col-lg-12 ">--}}
                    {{--                        <div class="form-group subject">--}}
                    {{--                            <input id="coffee_hall" type="checkbox" name="coffee_hall" value="1">--}}
                    {{--                            <label>--}}
                    {{--                                <li><span class="icon flaticon-coffee-cup"></span> Кофе</li>--}}
                    {{--                            </label>--}}
                    {{--                            <input id="bar_hall" type="checkbox" name="bar_hall" value="1">--}}
                    {{--                            <label>--}}
                    {{--                                <li><span class="icon flaticon-wine-glass"></span> Мини-бар</li>--}}
                    {{--                            </label>--}}
                    {{--                            <input id="wifi_hall" type="checkbox" name="wifi_hall" value="1">--}}
                    {{--                            <label>--}}
                    {{--                                <li><span class="icon flaticon-wifi"></span> Wi-Fi</li>--}}
                    {{--                            </label>--}}
                    {{--                            <input id="tv_hall" type="checkbox" name="tv_hall" value="1">--}}
                    {{--                            <label>--}}
                    {{--                                <li><span class="icon flaticon-tv"></span> Телевизор</li>--}}
                    {{--                            </label>--}}
                    {{--                            <input id="lamp_hall" type="checkbox" name="lamp_hall" value="1">--}}
                    {{--                            <label>--}}
                    {{--                                <li><span class="icon flaticon-light"></span> Свет</li>--}}
                    {{--                            </label>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
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
                                    <div class="price">Площадь <span>{{$hall->area_hall}}</span></div>
                                    <div class="rating">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    </div>
                                </div>

                                <div class="text">{{$hall->description_hall}}</div>
                                <div class="link-box"><a href="/my_hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}"
                                                         class="theme-btn btn-style-three"><span
                                            class="btn-title">Редактировать зал</span></a></div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h1>Залы отсутвуют</h1>
                @endforelse
            </div>
        </div>
    </section>
</x-layout>
