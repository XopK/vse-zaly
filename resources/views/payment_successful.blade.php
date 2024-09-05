<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="/images/favicon.png" type="image/x-icon">
    <title>Оплата успешно выполнена</title>
    <style>
        body {
            background-color: #f0f0f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 60px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #4CAF50;
            font-size: 36px;
        }

        p {
            font-size: 18px;
            color: #333;
        }

        .checkmark {
            font-size: 100px;
            color: #4CAF50;
            margin-bottom: 50px;
        }

        .btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 18px;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #37813b;
            color: #ffffff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="checkmark">✔</div>
    <h1>Оплата выполнена!</h1>
    <p>Ваш заказ был успешно оплачен.</p>
    <p>Спасибо за бронирование!</p>
    <a href="/my_booking" class="btn">Мои бронирования</a>
</div>
</body>
</html>
