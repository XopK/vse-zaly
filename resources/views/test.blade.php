<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .custom-input {
            width: 60px;
        }

        .btn-group-icon {
            display: flex;
            align-items: center;
        }

        .btn-group-icon button {
            margin-left: 5px;
        }

        .form-row .col-auto {
            padding-right: 0.5rem;
            padding-left: 0.5rem;
        }

        @media (max-width: 768px) {
            .custom-input {
                width: 50px;
            }

            .btn-group-icon {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="form-row align-items-center">
        <!-- Часть с количеством людей -->
        <div class="col-auto d-flex align-items-center">
            <span>От</span>
        </div>
        <div class="col-auto">
            <input type="text" class="form-control custom-input" placeholder="1">
        </div>
        <div class="col-auto d-flex align-items-center">
            <span>до</span>
        </div>
        <div class="col-auto">
            <input type="text" class="form-control custom-input" placeholder="__">
        </div>
        <div class="col-auto d-flex align-items-center">
            <span>чел.</span>
        </div>

        <!-- Время: Будни, Вечер и т.д. -->
        <div class="col-sm-12 col-md-6 mt-2 mt-md-0">
            <div class="form-row">
                <div class="col-6 col-sm">
                    <input type="text" class="form-control" placeholder="Будни">
                </div>
                <div class="col-6 col-sm">
                    <input type="text" class="form-control" placeholder="Будни/Вечер">
                </div>
                <div class="col-6 col-sm mt-2 mt-sm-0">
                    <input type="text" class="form-control" placeholder="Выходные">
                </div>
                <div class="col-6 col-sm mt-2 mt-sm-0">
                    <input type="text" class="form-control" placeholder="Выходные/Вечер">
                </div>
            </div>
        </div>

        <!-- Кнопки "+" и "×" -->
        <div class="col-auto btn-group-icon mt-2 mt-md-0">
            <button class="btn btn-outline-secondary">+</button>
            <button class="btn btn-outline-secondary">×</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
