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
                            <h2>Emma Connor</h2>
                            <img src="https://placehold.co/340x340" alt="avatar" class="img-fluid profile-img">
                        </div>
                        <!-- Detail -->
                        <div class="detail-clearfix">
                            <ul>
                                <li>
                                    <a href="user-profile.html" class="active">
                                        <i class="flaticon-user"></i>Профиль
                                    </a>
                                </li>
                                <li>
                                    <a href="my-properties.html">
                                        <i class="flaticon-house"></i>My Properties
                                    </a>
                                </li>
                                <li>
                                    <a href="favorited-properties.html">
                                        <i class="flaticon-heart-shape-outline"></i>Favorited Properties
                                    </a>
                                </li>
                                <li>
                                    <a href="submit-property.html">
                                        <i class="flaticon-add"></i>Submit New Property
                                    </a>
                                </li>
                                <li>
                                    <a href="change-password.html">
                                        <i class="flaticon-locked-padlock"></i>Изменить пароль
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
                        <h3 class="heading-3">Profile Details</h3>
                        <form action="#" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <div class="form-group name">
                                        <label>Your Name</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="John Deo">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group email">
                                        <label>Your Title</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Your Title">
                                    </div>
                                </div>
                                <div class="col-lg-12 ">
                                    <div class="form-group subject">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-lg-12 ">
                                    <div class="form-group number">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group message">
                                        <label>Name</label>
                                        <textarea class="form-control" name="message" placeholder="Write message"></textarea>
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
