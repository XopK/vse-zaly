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
                    @auth
                        <form method="post" action="{{ route('become_partner.request_auth') }}" id="requestFromAuth">
                            @endauth
                            @guest
                                <form method="post" action="{{ route('request_partner') }}" id="requestFrom">
                                    @endguest
                                    @csrf
                                    @guest
                                        <div class="form-group">
                                            <label class="font-weight-bold">Почта<span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="emailReq" id="emailReq" class="form-control">
                                        </div>
                                        @error('emailReq')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @enderror
                                        <div class="form-group">
                                            <label class="font-weight-bold">Имя<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="nameReq" id="nameReq" class="form-control">
                                        </div>
                                        @error('nameReq')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @enderror
                                    @endguest
                                    <div class="form-group">
                                        <label class="font-weight-bold">Название студии<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="nameStudio" id="nameStudio" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Деятельность студии</label>
                                        <textarea rows="5" name="studioActivities" id="studioActivities"
                                                  placeholder="Напишите кратко чем занимается ваша студия"
                                                  class="form-control"></textarea>
                                    </div>
                                    @error('nameStudio')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @enderror
                                    <div class="form-group">
                                        <label class="font-weight-bold">Адрес студии<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="addressStudio" id="addressStudio" class="form-control">
                                    </div>
                                    @error('addressStudio')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @enderror
                                    @guest
                                        <div class="form-group">
                                            <label class="font-weight-bold">Телефон</label>
                                            <input type="text" name="phoneReq" id="phonestudios"
                                                   placeholder="+7(___)-___-____"
                                                   class="form-control">
                                        </div>
                                        @error('phoneReq')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @enderror

                                        <div class="form-group">
                                            <label class="font-weight-bold">Пароль<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="passwordReq" id="passwordReq"
                                                   class="form-control"
                                                   required>
                                        </div>
                                        @error('passwordReq')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @enderror
                                        <div class="form-group">
                                            <label class="font-weight-bold">Подтвердите пароль<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="confirmPasswordReq" id="confirmPasswordReq"
                                                   class="form-control" required>
                                        </div>
                                        @error('confirmPasswordReq')
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @enderror
                                    @endguest
                                    <div class="form-group">
                                        <label><input type="checkbox" name="signupcondition" id="requestcondition"
                                                      required> Я
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
</x-layout>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"
        type="text/javascript"></script>
<script>
    $("#phonestudios").mask("+7(999)-999-9999");
</script>
