<x-layout>
    <div class="container forget-password" style="margin-top: 250px; margin-bottom: 250px">
        <div class="row">
            <div class="col-md-12 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2 class="text-center">Изменение пароля</h2>
                        <form id="register-form" role="form" action="{{ route('reset_update_password') }}"
                            autocomplete="off" class="form" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label class="font-weight-bold">Придумайте новый пароль</label>
                                <div class="input-group">
                                    <input id="password" name="password" class="form-control" type="password">
                                </div>
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
                                <label class="font-weight-bold">Подтвердите пароль</label>
                                <div class="input-group">
                                    <input id="confirmpassword" name="confirmpassword" class="form-control"
                                        type="password">
                                </div>
                            </div>
                            @error('confirmpassword')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @enderror
                            <div class="form-group">
                                <button type="submit" class="theme-btn btn-style-one btn-block"><span
                                        class="btn-title">Изменить пароль</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
