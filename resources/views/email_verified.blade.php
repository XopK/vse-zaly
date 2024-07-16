<x-layout>
    <div class="user-page content-area-7 submit-property" style="margin: 120px 0">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Подтверждение почты</div>
                        <div class="card-body">
                            <form action="submit.php" method="POST">
                                <div class="form-group">
                                    <label for="email">Адрес электронной почты</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="code">Код подтверждения</label>
                                    <input type="text" class="form-control" id="code" name="code" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Отправить код</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
