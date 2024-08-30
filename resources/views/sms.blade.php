<x-layout>
    <div class="user-page content-area-7 submit-property" style="margin: 120px 0">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Подтверждение номера телефона <br></div>
                        <div class="card-body">
                            <form id="confirmationForm" action="{{route('check_code')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="code">На номер {{$user->phone}} был отправлен код.</label>
                                    <input type="tel" class="form-control" id="code" name="code" required>
                                </div>
                                @error('code')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror
                                @if (session('error_verify'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ session('error_verify') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="send-btn">
                                    <button type="submit" class="theme-btn btn-style-one"><span
                                            class="btn-title">Отправить</span></button>

                                    <a style="margin-left: 20px" data-toggle="modal"
                                       data-target="#changePhoneModal">Изменить номер</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
<div class="modal fade" id="changePhoneModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modal_change">Изменить номер</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/verify_phone/change" method="post" id="change">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold">Телефон <span class="text-danger">*</span></label>
                        <input type="text" name="changePhone" value="{{$user->phone}}"
                               id="changePhone" placeholder="+7(___)-___-____" class="form-control">
                    </div>
                    @error('changePhone')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                <button type="submit" class="btn btn-primary" id="apply" form="change">Да</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js"
        type="text/javascript"></script>
<script>
    $("#changePhone").mask("+7(999)-999-9999");
</script>

