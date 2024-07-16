<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Аренда залов в Уфе</title>
    <!-- Stylesheets -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Responsive File -->
    <link href="css/responsive.css" rel="stylesheet">

    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">

    <!-- Responsive Settings -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>

    <div class="page-wrapper">
        <!-- Preloader -->
        <div class="preloader">
            <div class="icon"></div>
        </div>

        <!-- Main Header -->
        <header class="main-header header-style-one">

            <!-- Header Upper -->
            <div class="header-upper">
                <div class="inner-container clearfix">
                    <!--Logo-->
                    <div class="logo-box">
                        <div class="logo"><a href="/" title="Hotera - Hotel and Restaurant HTML Template"><img
                                    src="images/black-logo.png" alt="Hotera - Hotel and Restaurant HTML Template"
                                    title="Hotera - Hotel and Restaurant HTML Template"></a></div>
                    </div>
                    <div class="nav-outer clearfix">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler"><span class="icon flaticon-menu-2"></span><span
                                class="txt">Меню</span></div>

                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li class="dropdown"><a href="/">Главная</a></li>
                                    @auth
                                        <li class="dropdown"><a href="/profile">Личный профиль</a></li>
                                    @endauth
                                    <li><a href="/about">О нас</a></li>

                                    <li class="dropdown"><a href="/terms">Правила залов</a></li>

                                    <li class="dropdown"><a href="/halls">Залы</a></li>

                                    <li class="dropdown"><a href="/studios">Студии</a></li>
                                    @auth
                                    <li><a href="/rent">Долгосрочная аренда</a></li>
                                    @endauth
                                    @guest
                                        <li class="dropdown"><a data-toggle="modal" data-target="#logModal">Авторизация</a></li>
                                        <li class="dropdown"><a href="/become_partner">Стать партнёром</a></li>
                                    @endguest
                                </ul>
                            </div>
                        </nav>
                    </div>
                    
                </div>
            </div>
            <!--End Header Upper-->

            <!-- Mobile Menu  -->
            <div class="mobile-menu">
                <div class="close-btn"><span class="icon flaticon-targeting-cross"></span></div>
                <div class="menu-backdrop"></div>
                <div class="nav-logo"><a href="index.html"><img src="images/nav-logo.png" alt="logo"
                            title=""></a></div>
                <nav class="menu-box">
                    <div class="menu-outer">
                        <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                    </div>
                </nav>
                <div class="nav-bottom">
                    <div class="copyright">Все залы &copy; 2024 Все права защищены</div>
                    <!--Social Links-->
                    <div class="social-links">
                        <ul class="clearfix">
                            <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                            <li><a href="#"><span class="fab fa-telegram"></span></a></li>
                            <li><a href="#"><span class="fab fa-vk"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Mobile Menu -->

        </header>
        <!-- End Main Header -->

        {{ $slot }}

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="top-pattern-layer-dark"></div>

            <!--Widgets Section-->
            <div class="widgets-section">
                <div class="auto-container">
                    <div class="row clearfix">

                        <!--Column-->
                        <div class="column col-xl-3 col-lg-12 col-md-12 col-sm-12">
                            <div class="footer-widget about-widget">
                                <div class="logo">
                                    <a href="#"><img src="images/footer-logo.png" alt=""></a>
                                </div>
                            </div>
                        </div>

                        <!--Column-->
                        <div class="column col-xl-5 col-lg-8 col-md-12 col-sm-12">
                            <div class="footer-widget links-widget">
                                <div class="widget-content">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="widget-title">
                                                <h4>Страницы</h4>
                                            </div>
                                            <ul class="links">
                                                <li><a href="/">Главная</a></li>
                                                <li><a href="/about">О нас</a></li>
                                                <li><a href="/terms">Правила залов</a></li>
                                                <li><a href="/rent">Долгосрочная аренда</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="widget-title">
                                                <h4>Контакты</h4>
                                            </div>
                                            <ul class="info">
                                                <li class="address">г. Уфа, ул. Бульвар Ибрагимова 88, 1 этаж
                                                </li>
                                                <li class="phone"><a href="tel:+7 917 753 2370">+7 917 753 2370</a>
                                                </li>
                                                <li class="email"><a
                                                        href="mailto:vse-zaly@yandex.ru">vse-zaly@yandex.ru</a></li>
                                                <li class="social-links">
                                                    <a href="#"><span class="fab fa-instagram"></span></a>
                                                    <a href="#"><span class="fab fa-telegram"></span></a>
                                                    <a href="#"><span class="fab fa-vk"></span></a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Column-->
                        <div class="column col-xl-4 col-lg-4 col-md-12 col-sm-12">
                            <div class="footer-widget newsletter-widget">
                                <div class="widget-title">
                                    <h4>Связаться с нами</h4>
                                </div>
                                <div class="text">Есть вопросы или предложения как улучшить сайт? Напишите нам </div>
                                <!--Newsletter-->
                                <div class="newsletter-form">
                                    <form method="post" action="contact.html">
                                        <div class="form-group clearfix">
                                            <input type="email" name="email" value="" placeholder="Email"
                                                required>
                                            <button type="submit" class="theme-btn btn-style-one"><span
                                                    class="btn-title">Отправить</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="auto-container">
                    <div class="inner clearfix">
                        <div class="copyright">&copy; 2024 Все залы - Все права защищены</div>
                        <div class="bottom-links">
                            <a href="#">Пользовательское соглашение</a> &ensp;|&ensp; <a href="#">Политика конфиденциальности</a>
                        </div>
                    </div>
                </div>
            </div>

        </footer>

    </div>
    <!--End pagewrapper--><!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="flaticon-up-arrow"></span></div>

    <script src="js/jquery.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery.fancybox.js"></script>
    <script src="js/owl.js"></script>
    <script src="js/scrollbar.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/custom-script.js"></script>
    <x-auth></x-auth>
</body>

</html>
