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

        .border-bto2 {
            /* border-top: 1px solid #ddd; */
        }

        .booking-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .booking-list li {
            display: flex;
            background: #f9f9f9;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .booking_info h4 {
            margin: 0 0 5px;
        }

        .booking_info p {
            margin: 0;
        }

        .booking_photo {
            max-width: 240px;
            max-height: 240px;
            padding-right: 20px;
        }

        .booking_info button {
            margin-top: 10px;
            padding: 10px;
            color: white;
            background-color: black;
            border: 1px solid black;
            transition: background-color 0.3s, color 0.3s;
        }

        .booking_info button:hover {
            margin-top: 10px;
            padding: 10px;
            color: rgb(0, 0, 0);
            background-color: rgb(255, 255, 255);
            border: 1px solid black;
            transition: background-color 0.3s, color 0.3s;
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
                                    <a href="/my_booking">
                                        <i class="flaticon-house"></i>Бронирования
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
                        @if (Auth::user()->id_role == 1)
                        <h3 class="heading-3">Мои брони</h3>
                        <ul class="booking-list">
                            <li>
                                <a href="hall">
                                    <div class="booking_photo">
                                        <img src="/images/halls/IMG_5441.jpeg" alt="Фото зала">
                                    </div>
                                </a>
                                <div class="booking_info">
                                    <h4>Название зала: Зал для конференций</h4>
                                    <p>Дата бронирования: 2023-07-16</p>
                                    <p>Время: 10:00 - 14:00</p>
                                    <a href="/delete_booking">
                                        <button>Отменить бронь</button>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        @endif
                    </div>
                    @if (Auth::user()->id_role == 2)
                    <div class="my-address contact-2">
                        <h3 class="heading-3">Активные брони</h3>
                        <ul class="booking-list">
                            <li>
                                <a href="hall">
                                    <div class="booking_photo">
                                        <img src="/images/halls/IMG_5441.jpeg" alt="Фото зала">
                                    </div>
                                </a>
                                <div class="booking_info">
                                    <h4>Название зала: Зал для конференций</h4>
                                    <p>Дата бронирования: 2023-07-16</p>
                                    <p>Время: 10:00 - 14:00</p>
                                    <a href="/delete_booking">
                                        <button>Отменить бронь</button>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <h3 class="heading-3">Архив бронирований</h3>
                    <ul class="booking-list">
                        <li>
                            <a href="hall">
                                <div class="booking_photo">
                                    <img src="/images/halls/IMG_5441.jpeg" alt="Фото зала">
                                </div>
                            </a>
                            <div class="booking_info">
                                <h4>Название зала: Зал белый</h4>
                                <p>Дата бронирования: 2023-02-23</p>
                                <p>Время: 17:00 - 21:00</p>
                            </div>
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- User page end -->

</x-layout>