<x-layout>
    <style>
        .detail-clearfix {
            border-radius: 4px;
            overflow: hidden;
            padding-right: 10px;
            margin-top: 10px
        }

        .detail-clearfix ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .detail-clearfix li {
            margin: 0;
        }

        .detail-clearfix a {
            border-top: 1px solid gray;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
        }

        .detail-clearfix a.active {
            background-color: black;
            color: #fff;
            font-weight: bold;
        }

        .detail-clearfix a:hover {
            background-color: black;
            color: white;

        }

        .detail-clearfix i {
            margin-right: 10px;
        }
    </style>
    <!-- Sub banner start -->
    <div class="sub-banner">
        <div class="container">
            <div class="breadcrumb-area">

            </div>
        </div>
    </div>
    <!-- Sub banner end -->

    <!-- User page start -->
    <div class="user-page content-area-7 submit-property" style="margin: 120px 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                    <div class="user-profile-box mrb">
                        <!--header -->
                        <div class="header clearfix">
                            <h3>{{ Auth::user()->name }}</h3>
                            <img src="/storage/users_profile/{{ Auth::user()->photo_profile }}" alt="avatar"
                                 style="min-width: 340px;  min-height: 340px; max-width: 340px; min-height: 340px; object-fit: cover;"
                                 class="img-fluid profile-img border">
                        </div>
                        <!-- Detail -->
                        <div class="detail-clearfix">
                            <ul>
                                @if (Auth::user()->id_role == 1)
                                    <li>
                                        <a href="/profile" class="active">
                                            <i class="flaticon-user"></i>Профиль
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/my_booking">
                                            <i class="flaticon-house"></i>Мои брони
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/favourite_properties">
                                            <i class="flaticon-heart"></i>Избранные залы
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ Auth::user()->email_verified_at ? '/change_password' : '/email_confirm' }}">
                                            <i class="flaticon-lock"></i>Изменить пароль
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" class="border-bto2">
                                            <i class="flaticon-logout"></i>Выйти
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->id_role == 2)
                                    <li>
                                        <a href="/profile" class="active">
                                            <i class="flaticon-user"></i>Профиль
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ Auth::user()->email_verified_at ? '/change_password' : '/email_confirm' }}">
                                            <i class="flaticon-lock"></i>Изменить пароль
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" class="border-bto2">
                                            <i class="flaticon-logout"></i>Выйти
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="my-address contact-2">
                        <h3 class="heading-3">Изменить данные</h3>
                        <form action="{{ route('update_personal_data') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <div class="form-group name">
                                        <label>Имя</label>
                                        <input type="text" name="name" class="form-control"
                                               value="{{ Auth::user()->name }}">
                                    </div>
                                    @error('name')
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
                                        <label>Почта</label>
                                        <input type="email" name="email" class="form-control"
                                               value="{{ Auth::user()->email }}">
                                    </div>
                                    @error('email')
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
                                        <label>Телефон</label>
                                        <input id="userphone" type="text" name="phone" class="form-control"
                                               value="{{ Auth::user()->phone }}">
                                    </div>
                                    @error('phone')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @enderror
                                </div>
                                @if (Auth::user()->id_role == 1)
                                    <div class="col-lg-12 ">
                                        <div class="form-group subject">
                                            <label>Telegram</label>
                                            <input id="usertg" type="text" name="tg" class="form-control"
                                                   value="{{ Auth::user()->telegram }}">
                                        </div>
                                        @error('tg')
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
                                            <label>VK</label>
                                            <input id="uservk" type="text" name="vk" class="form-control"
                                                   value="{{ Auth::user()->vk }}">
                                        </div>
                                        @error('vk')
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
                                            <label>Instagram</label>
                                            <input id="userinst" type="text" name="inst" class="form-control"
                                                   value="{{ Auth::user()->instagram }}">
                                        </div>
                                        @error('inst')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @enderror
                                    </div>
                                @endif

                                <div class="col-lg-12 ">
                                    <div class="form-group photo">
                                        <label>Фото</label>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="photo_user"
                                                       accept="image/*" id="inputGroupFile01"
                                                       aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="inputGroupFile01">Выберите
                                                    файл</label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('photo_user')
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
                                        <button type="submit" class="theme-btn btn-style-one"><span class="btn-title">Сохранить</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        @if (Auth::user()->email_verified_at == null)
                            <a href="/email_confirm" style="text-decoration: none">
                                <div class="alert alert-warning mt-4" role="alert">
                                    <strong>Ваша учетная запись не подтверждена.</strong><br>
                                    Для завершения процесса, пожалуйста, подтвердите
                                    адрес электронной почты, нажав на это сообщение.
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- User page end -->
    <script>
        document.querySelector('.custom-file-input').addEventListener('change', function (event) {
            var input = event.target;
            var label = input.nextElementSibling;
            var fileName = input.files.length > 0 ? input.files[0].name : 'Выбрать файл';
            label.textContent = fileName;
        });
    </script>
</x-layout>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"
        type="text/javascript"></script>
<script>
    $("#userphone").mask("+7(999)-999-9999");
</script>
