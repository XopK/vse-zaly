<x-profile>
    <div class="my-address contact-2">
        <h3 class="heading-3">Изменить пароль</h3>
        <form action="{{ route('update_password') }}" method="POST">
            @csrf
            @if (session('error_change_password'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('error_change_password') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('success_change_password'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success_change_password') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="form-group name">
                        <label>Старый пароль</label>
                        <input type="password" name="password_old" class="form-control">
                    </div>
                    @error('password_old')
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
                        <label>Новый пароль</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>
                    @error('new_password')
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
                        <label>Подтвердите пароль</label>
                        <input type="password" name="new_password_confirm" class="form-control">
                    </div>
                    @error('new_password_confirm')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-lg-12">
                <div class="send-btn" style="margin-left: -15px;">
                    <button type="submit" class="theme-btn btn-style-one"><span
                            class="btn-title">Сохранить</span></button>
                </div>
            </div>
        </form>
    </div>
</x-profile>
