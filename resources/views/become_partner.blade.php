<x-layout>
    <style>
        .info_about_studio {
            padding-bottom: 20px;
            font-size: 24px
        }
        
    </style>
    <!-- Banner Section -->
    <section class="page-banner">
        <div class="image-layer" style="background-image:url(images/background/rent.jpg);"></div>
        <div class="banner-bottom-pattern"></div>

        <div class="banner-inner">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <h1>Стать партнёром</h1>
                </div>
            </div>
        </div>
    </section>
    <!--End Banner Section -->

    <!--Contact Section-->
    <section class="contact-section-two">

        <div class="auto-container clearfix">
            <p class="info_about_studio">У тебя своя студия и ты хочешь стать партнёром?<br>Заполни форму ниже и мы
                рассмотрим твою заявку как можно скорее!</p>
            <div class="row clearfix">


                <div class="col-sm-12 shadow rounded pt-2 pb-2">
                    <form method="post" action="{{ route('signup') }}" id="singnupFrom">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-bold">Почта <span class="text-danger">*</span></label>
                            <input type="email" name="signupemail" id="signupemail" class="form-control" required>
                        </div>
                        @error('signupemail')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                        <div class="form-group">
                            <label class="font-weight-bold">Имя<span class="text-danger">*</span></label>
                            <input type="text" name="signupusername" id="signupusername" class="form-control"
                                required>
                        </div>
                        @error('signupusername')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                        <div class="form-group">
                            <label class="font-weight-bold">Название студии<span class="text-danger">*</span></label>
                            <input type="text" name="signupusername" id="signupusername" class="form-control"
                                required>
                        </div>
                        @error('signupusername')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                        <div class="form-group">
                            <label class="font-weight-bold">Телефон</label>
                            <input type="text" name="signupphone" id="phonestudios" placeholder="+7(___)-___-____"
                                class="form-control">
                        </div>
                        @error('signupphone')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                        <div class="form-group">
                            <label class="font-weight-bold">Пароль<span class="text-danger">*</span></label>
                            <input type="password" name="signuppassword" id="signuppassword" class="form-control"
                                required>
                        </div>
                        @error('signuppassword')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                        <div class="form-group">
                            <label class="font-weight-bold">Подтвердите пароль<span class="text-danger">*</span></label>
                            <input type="password" name="signupcpassword" id="signupcpassword" class="form-control"
                                required>
                        </div>
                        @error('signupcpassword')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                        <div class="form-group">
                            <label><input type="checkbox" name="signupcondition" id="signupcondition" required> Я
                                соглашаюсь с <a href="javascript:;">Условиями и
                                    Положениями</a> для регистрации.</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="theme-btn btn-style-one btn-block"><span
                                    class="btn-title">Стать партнером</span></button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </section>

    <!--Map Section-->
    {{-- <section class="map-section">
        <div class="map-layer">
            <div class="map-canvas" data-zoom="12" data-lat="-37.817085" data-lng="144.955631" data-type="roadmap"
                data-hue="#ffc400" data-title="Singapore" data-icon-path="images/icons/map-marker.png"
                data-content="Singapore VIC 3000, USA<br><a href='mailto:info@youremail.com'>info@youremail.com</a>">
            </div>
        </div>
    </section> --}}

</x-layout>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"
    type="text/javascript"></script>
<script>
    $("#phonestudios").mask("+7(999)-999-9999");
</script>
