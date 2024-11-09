<!-- Modal -->
<div class="modal fade" id="logModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <ul class="nav nav-pills nav-fill mb-1 p-3" id="pills-tab" role="tablist">
                <li class="nav-item"><a class="nav-link active" id="pills-signin-tab" data-toggle="pill"
                                        href="#pills-signin" role="tab" aria-controls="pills-signin"
                                        aria-selected="true">Вход</a>
                </li>
                <li class="nav-item"><a class="nav-link" id="pills-signup-tab" data-toggle="pill" href="#pills-signup"
                                        role="tab" aria-controls="pills-signup" aria-selected="false">Регистрация</a>
                </li>
            </ul>
            <div class="tab-content p-3" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-signin" role="tabpanel"
                     aria-labelledby="pills-signin-tab">
                    <div class="col-sm-12 shadow rounded pt-2 pb-2">
                        <form method="post" action="{{ route('signin') }}" id="singninFrom">
                            @csrf
                            @if (session('error_signin'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('error_signin') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="font-weight-bold">Номер телефона или почта <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="emailOrPhone" id="emailOrPhone" class="form-control"
                                       required>
                            </div>
                            @error('emailOrPhone')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror
                            <div class="form-group">
                                <label class="font-weight-bold">Пароль <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            @error('password')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label><input type="checkbox" name="remember" id="remember">
                                            Запомнить меня</label>
                                    </div>
                                    <div class="col text-right"><a href="/forgot_password">Забыл пароль?</a></div>
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
                        <form method="post" action="{{ route('signup') }}" id="singnupFrom">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Почта <span class="text-danger">*</span></label>
                                <input type="email" name="signupemail" value="{{ old('signupemail') }}"
                                       id="signupemail" class="form-control" required>
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
                                <label class="font-weight-bold">Имя <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('signupusername') }}" name="signupusername"
                                       id="signupusername" class="form-control" required>
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
                                <label class="font-weight-bold">Телефон <span class="text-danger">*</span></label>
                                <input type="text" name="signupphone" value="{{ old('signupphone') }}"
                                       id="signupphone" placeholder="+7(___)-___-____" class="form-control">
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
                                <label class="font-weight-bold">Пароль <span class="text-danger">*</span></label>
                                <input type="password" name="signuppassword" id="signuppassword"
                                       class="form-control" required>
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
                                <label class="font-weight-bold">Подтвердите пароль <span
                                        class="text-danger">*</span></label>
                                <input type="password" name="signupcpassword" id="signupcpassword"
                                       class="form-control" required>
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
                                <label class="font-weight-bold">Telegram</label>
                                <input type="text" name="tg" value="{{ old('tg') }}"
                                       id="signuptg" class="form-control">
                            </div>
                            @error('tg')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror
                            <div class="form-group">
                                <label class="font-weight-bold">VK</label>
                                <input type="text" name="vk" value="{{ old('vk') }}"
                                       id="vk" class="form-control">
                            </div>
                            @error('vk')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror
                            <div class="form-group">
                                <label class="font-weight-bold">Instagam</label>
                                <input type="text" name="inst" value="{{ old('inst') }}"
                                       id="signupinst" class="form-control">
                            </div>
                            @error('inst')
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
                                        class="btn-title">Регистрация</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"
        type="text/javascript"></script>
<script>
    $("#signupphone").click(function () {
        $(this).setCursorPosition(3);
    }).mask("+7(999)-999-9999");
</script>
@if (
    $errors->has('signupemail') ||
        $errors->has('signupusername') ||
        $errors->has('signupphone') ||
        $errors->has('signuppassword') ||
        $errors->has('signupcpassword'))
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const modal = new bootstrap.Modal(document.getElementById('logModal'));
            modal.show();
            document.getElementById('pills-signup-tab').click();
        });
    </script>
@endif

@if ($errors->has('emailOrPhone') || $errors->has('password') || session('error_signin'))
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const modal = new bootstrap.Modal(document.getElementById('logModal'));
            modal.show();
        });
    </script>
@endif
