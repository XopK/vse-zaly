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

        .send-btn{
            margin-left: -15px;
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
                            <img src="https://placehold.co/340x340" alt="avatar" class="img-fluid profile-img">
                        </div>
                        <!-- Detail -->
                        <div class="detail-clearfix">
                            <ul>
                                <li>
                                    <a href="/profile">
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
                                    <a href="/change_password"  class="active">
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
                    <div class="my-address contact-2">
                        <h3 class="heading-3">Изменить пароль</h3>
                        <form action="{{ route('update_personal_data') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <div class="form-group name">
                                        <label>Старый пароль</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12 ">
                                    <div class="form-group subject">
                                        <label>Новый пароль</label>
                                        <input type="password" name="new_password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12 ">
                                    <div class="form-group number">
                                        <label>Подтвердите пароль</label>
                                        <input type="password" name="new_password_confirm" class="form-control">
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="send-btn">
                                        <button type="submit" class="theme-btn btn-style-one"><span
                                                class="btn-title">Сохранить</span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- User page end -->

</x-layout>
