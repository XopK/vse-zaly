<x-profile>
    <div class="my-address contact-2">
        <h3 class="heading-3">Изменить данные</h3>
        <form action="{{ route('update_personal_data') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="form-group name">
                        <label>Имя</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
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
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
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


                <div class="col-lg-12 ">
                    <div class="form-group photo">
                        <label>Фото</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="photo_user" accept="image/*"
                                    id="inputGroupFile01">
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
                        <button type="submit" class="theme-btn btn-style-one"><span
                                class="btn-title">Сохранить</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        @if (Auth::user()->email_verified_at == null)
            <a href="/email_confirm" style="text-decoration: none">
                <div class="alert alert-warning mt-4" role="alert">
                    <strong>Ваша учетная запись не подтверждена.</strong><br>
                    Для завершения процесса регистрации, пожалуйста, подтвердите
                    адрес электронной почты, нажав на это сообщение.
                </div>
            </a>
        @endif
    </div>
    <script>
        document.querySelector('.custom-file-input').addEventListener('change', function(event) {
            var input = event.target;
            var label = input.nextElementSibling;
            var fileName = input.files.length > 0 ? input.files[0].name : 'Выбрать файл';
            label.textContent = fileName;
        });
    </script>
</x-profile>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"
    type="text/javascript"></script>
<script>
    $("#userphone").mask("+7(999)-999-9999");
</script>
