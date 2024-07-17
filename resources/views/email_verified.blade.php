<x-layout>
    <div class="user-page content-area-7 submit-property" style="margin: 120px 0">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Подтверждение почты</div>
                        <div class="card-body">
                            <form id="confirmationForm" action="{{ route('verifyEmail') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="code">Код подтверждения</label>
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
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="send-btn">
                                        <button type="submit" class="theme-btn btn-style-one"><span
                                                class="btn-title">Отправить</span></button>
                                    </div>
                                    <div class="form-group ">
                                        <span id="countdown"></span>
                                        <button type="button" class="btn btn-secondary" id="getCodeBtn">Получить
                                            код</button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
<script>
    function sendRequest() {
        $.ajax({
            url: '/email_confirm/get_code',
            type: 'GET',
            success: function(response) {
                console.log('Код успешно отправлен');
            },
            error: function(xhr, status, error) {
                console.error('Ошибка при отправке запроса:', error);
            }
        });
    }
    document.getElementById('getCodeBtn').addEventListener('click', function() {
        var btn = this;
        btn.disabled = true;
        sendRequest();

        var countdown = 60;
        var timer = setInterval(function() {
            countdown--;
            document.getElementById('countdown').textContent = ' (ожидание ' + countdown + ' секунд)';

            if (countdown <= 0) {
                clearInterval(timer);
                btn.disabled = false;
                document.getElementById('countdown').textContent = '';
            }
        }, 1000);
    });
</script>
