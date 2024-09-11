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
    <div class="user-page content-area-7 submit-property" style="margin: 40px 0">
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
                                <li>
                                    <a href="/profile" class="{{ Request::is('profile') ? 'active' : '' }}">
                                        <i class="flaticon-user"></i>Профиль
                                    </a>
                                </li>
                                <li>
                                    <a href="/favourite_properties"
                                       class="{{ Request::is('favourite_properties') ? 'active' : '' }}">
                                        <i class="flaticon-heart"></i>Избранные залы
                                    </a>
                                </li>
                                @if (Auth::user()->id_role == 1)
                                    <li>
                                        <a href="/my_booking" class="{{ Request::is('my_booking') ? 'active' : '' }}">
                                            <i class="flaticon-house"></i>Мои брони
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::user()->id_role == 2)
                                    <li>
                                        <a href="/my_booking" class="{{ Request::is('my_booking') ? 'active' : '' }}">
                                            <i class="flaticon-house"></i>Бронирования
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/my_halls_profile"
                                           class="{{ Request::is('my_halls_profile') ? 'active' : '' }}">
                                            <i class="flaticon-room"></i>Мои залы
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ Auth::user()->email_verified_at ? '/change_password' : '/email_confirm' }}"
                                       class="{{ Request::is('change_password') ? 'active' : '' }}">
                                        <i class="flaticon-lock"></i>Изменить пароль
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" class="border-bto2">
                                        <i class="flaticon-logout"></i>Выйти
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    <!-- User page end -->

</x-layout>

