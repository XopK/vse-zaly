<x-layout>
    <style>
        .studio_halls {
            width: 80%;
            display: flex;
            margin: 0 auto;
        }

        .studio_form {
            width: 30%;
            margin: 50px auto;
            /* border: 1px solid black; */
            padding: 20px;
        }

        @media (max-width: 768px) {
            .studio_form {
                width: 80%;
                margin: 50px auto;
            }
        }

        .halls {
            text-align: center;
        }

        .btn-outline-warning {
            color: #ffffff;
            border-color: #ffffff;
        }

        .btn-outline-warning:hover {
            color: white;
            background: #353535;
            border-color: #dfdfdf
        }

        .btn-outline-warning:focus {
            box-shadow: 0 0 0 .2rem rgb(225, 225, 225)
        }

        .btn-outline-warning:not(:disabled):not(.disabled).active, .btn-outline-warning:not(:disabled):not(.disabled):active, .show > .btn-outline-warning.dropdown-toggle {
            color: #ffffff;
            background-color: #353535;
            border-color: #dfdfdf
        }

        .btn-outline-warning:not(:disabled):not(.disabled).active:focus, .btn-outline-warning:not(:disabled):not(.disabled):active:focus, .show > .btn-outline-warning.dropdown-toggle:focus {
            box-shadow: 0 0 0 .2rem rgb(225, 225, 225)
        }
    </style>
    <!-- Banner Section -->
    <section class="page-banner">
        <div class="image-layer"
             style="background-image:url('/storage/banner_studio/{{Auth::user()->studio->banner_studio}}');"></div>
        <div class="banner-bottom-pattern"></div>

        <div class="banner-inner">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <h1 class="mb-2">Моя студия "{{ Auth::user()->studio->name_studio }}"</h1>
                    <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#filebanner">
                        Изменить баннер
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!--End Banner Section -->
    <section class="studio_form">
        <div class="col-sm-12 shadow rounded pt-2 pb-2">
            <form method="post" action="{{route('update_studio')}}" id="editStudio" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_studio" value="{{Auth::user()->studio->id}}">
                @if (session('error_studio'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error_studio') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('success_studio'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success_studio') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="form-group">
                    <label class="font-weight-bold">Название студии<span class="text-danger"></span></label>
                    <input value="{{ Auth::user()->studio->name_studio }}" type="text" name="studio_name"
                           id="studio_name" class="form-control" required>
                </div>
                @error('studio_name')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group">
                    <label class="font-weight-bold">Описание студии <span class="text-danger"></span></label>
                    <textarea class="form-control" rows="5" name="studio_description" id="studio_description"
                              required>{{ Auth::user()->studio->description_studio }}</textarea>
                </div>
                @error('studio_description')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group">
                    <label class="font-weight-bold">Почта студии<span class="text-danger"></span></label>
                    <input value="{{ Auth::user()->studio->email_studio }}" type="email" name="email_studio"
                           id="email_studio" class="form-control" required>
                </div>
                @error('email_studio')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group">
                    <label class="font-weight-bold">Телефон студии<span class="text-danger"></span></label>
                    <input value="{{ Auth::user()->studio->phone_studio }}" placeholder="+7(___)-___-____" type="tel"
                           name="phone_studio"
                           id="phone_studio" class="form-control" required>
                </div>
                @error('phone_studio')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group">
                    <label class="font-weight-bold">Адрес студии<span class="text-danger"></span></label>
                    <input value="{{ Auth::user()->studio->adress_studio }}" type="text"
                           name="adress_studio"
                           id="adress_studio" class="form-control" required>
                </div>
                @error('adress_studio')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group photo">
                    <label class="font-weight-bold">Фото студии</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="studio_photo" accept="image/*"
                                   id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Выберите
                                файл</label>
                        </div>
                    </div>
                </div>
                @error('studio_photo')
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

    <!--Featured Section-->
    <section class="featured-section-four about-page">
        <span class="dotted-pattern dotted-pattern-11"></span>
        <div class="circles-two">
            <div class="c-1"></div>
            <div class="c-2"></div>
        </div>
        <div class="auto-container">
            <div class="row clearfix">
                <!--Text Column-->
                <div class="text-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner">
                        <div class="sec-title">
                            <h2>{{ Auth::user()->studio->name_studio }}</h2>
                        </div>
                        <div class="text">{!! nl2br(e(Auth::user()->studio->description_studio)) !!}</div>
                    </div>
                </div>
                <!--Image Column-->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner">
                        <span class="dotted-pattern dotted-pattern-10"></span>
                        <div class="image-box clearfix">
                            <figure class="image wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms"><img
                                    src="/storage/photo_studios/{{Auth::user()->studio->photo_studio}}" alt=""
                                    title="">
                            </figure>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Facts Section-->
    @if(!$halls)
        <div class="halls">
            <h2 class="halls">Мои залы</h2>
        </div>
    @endif


    <div class="row clerfix">
        @forelse($halls->chunk(2) as $chunk)
            <div class="column col-xl-6 col-lg-6 col-md-6 col-sm-12">
                @foreach($chunk as $hall)
                    <div class="room-block-one height-one wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image-layer"
                                     style="background-image: url(/storage/photo_halls/{{$hall->preview_hall}});">
                                </div>
                                <figure class="image"><img src="/storage/photo_halls/{{$hall->preview_hall}}"
                                                           alt="{{$hall->preview_hall}}"
                                                           title="{{$hall->name_hall}}">
                                </figure>
                            </div>
                            <div class="cap-box">
                                <div class="cap-inner">
                                    <div class="price">Площадь <span>{{$hall->area_hall}}</span></div>
                                    <h5>{{$hall->name_hall}}</h5>
                                </div>
                            </div>
                            <div class="hover-box">
                                <div class="hover-inner">
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

                                    <div class="text text-truncate">{{$hall->description_hall}}</div>
                                    <div class="link-box"><a
                                            href="/my_hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}"
                                            class="theme-btn btn-style-one"><span
                                                class="btn-title">Просмотр зала</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @empty

        @endforelse
    </div>


</x-layout>
<div class="modal fade" id="filebanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Баннер для студии</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{route('update_banner')}}">
                    @csrf
                    <div class="col-lg-12 ">
                        <div class="form-group photo">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="banner_studio" accept="image/*"
                                           id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Выберите
                                        файл</label>
                                </div>
                            </div>
                        </div>
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

    document.addEventListener('DOMContentLoaded', function () {
        const textareas = document.querySelectorAll('textarea');

        function autoResize() {
            this.style.height = 'auto'; // Сброс текущей высоты
            this.style.height = this.scrollHeight + 'px'; // Установка высоты по содержимому
        }

        // Применяем функцию для всех textarea
        textareas.forEach(textarea => {
            textarea.style.height = textarea.scrollHeight + 'px'; // Установка высоты при загрузке
            textarea.addEventListener('input', autoResize); // Подстройка при вводе
        });
    });

    document.querySelectorAll('.custom-file-input').forEach(function (input) {
        input.addEventListener('change', function (event) {
            var input = event.target;
            var label = input.nextElementSibling;
            var fileName = input.files.length > 0 ? input.files[0].name : 'Выбрать файл';
            label.textContent = fileName;
        });
    });
</script>
<script>
    $("#phone_studio").mask("+7(999)-999-9999");
</script>
