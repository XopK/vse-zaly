<x-layout>
    <div class="container forget-password" style="margin-top: 250px; margin-bottom: 250px">
        <div class="row">
            <div class="col-md-12 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <img src="/images/icons/email.png" alt="car-key" border="0">
                            <h2 class="text-center">Забыли пароль?</h2>
                            <form id="register-form" role="form" action="{{ route('resetPassword') }}"
                                autocomplete="off" class="form" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="email" name="email"
                                            placeholder="Введите почту которую указывали при регистрации"
                                            class="form-control" type="email">
                                    </div>
                                </div>
                                @error('email')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <button type="submit" class="theme-btn btn-style-one btn-block  "><span
                                            class="btn-title">Восстановить пароль</span></button>
                                </div>
                                @if (session('message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ session('message') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session('message_error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ session('message_error') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
