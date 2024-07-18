<x-layout>
    <div class="user-page content-area-7 submit-property" style="margin: 120px 0">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">На вашу почту пришел код для подтверждения</div>
                        <div class="card-body">
                            <form id="confirmationForm" action="{{ route('newEmailChange') }}" method="POST">
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
                                <div class="send-btn">
                                    <button type="submit" class="theme-btn btn-style-one"><span
                                            class="btn-title">Отправить</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-layout>
