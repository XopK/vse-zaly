<!-- Modal -->
<div class="modal fade" id="logModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <ul class="nav nav-pills nav-fill mb-1 p-3" id="pills-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" id="pills-signin-tab" data-toggle="pill"
                        href="#pills-signin" role="tab" aria-controls="pills-signin" aria-selected="true">Вход</a>
                </li>
                <li class="nav-item"> <a class="nav-link" id="pills-signup-tab" data-toggle="pill" href="#pills-signup"
                        role="tab" aria-controls="pills-signup" aria-selected="false">Регистрация</a></li>
            </ul>
            <div class="tab-content p-3" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-signin" role="tabpanel"
                    aria-labelledby="pills-signin-tab">
                    <div class="col-sm-12 shadow rounded pt-2 pb-2">
                        <form method="post" id="singninFrom">
                            <div class="form-group">
                                <label class="font-weight-bold">Номер телефона или почта <span
                                        class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Пароль <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label><input type="checkbox" name="condition" id="condition">
                                            Запомнить меня</label>
                                    </div>
                                    <div class="col text-right"> <a href="javascript:;" data-toggle="modal"
                                            data-target="#forgotPass">Забыл пароль?</a> </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="theme-btn btn-style-one btn-block  "><span
                                        class="btn-title">Войти</span></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-signup" role="tabpanel" aria-labelledby="pills-signup-tab">
                    <div class="col-sm-12 shadow rounded pt-2 pb-2">
                        <form method="post" id="singnupFrom">
                            <div class="form-group">
                                <label class="font-weight-bold">Почта <span class="text-danger">*</span></label>
                                <input type="email" name="signupemail" id="signupemail" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Имя<span class="text-danger">*</span></label>
                                <input type="text" name="signupusername" id="signupusername" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Телефон</label>
                                <input type="text" name="signupphone" id="signupphone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Пароль<span class="text-danger">*</span></label>
                                <input type="password" name="signuppassword" id="signuppassword" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Подтвердите пароль<span
                                        class="text-danger">*</span></label>
                                <input type="password" name="signupcpassword" id="signupcpassword"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label><input type="checkbox" name="signupcondition" id="signupcondition" required> Я
                                    соглашаюсь с <a href="javascript:;">Условиями и
                                        Положениями</a> для регистрации.</label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="theme-btn btn-style-one btn-block"><span
                                        class="btn-title">Регистрация</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
