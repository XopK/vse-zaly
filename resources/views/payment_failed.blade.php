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
    <title>Ошибка бронирования</title>
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
            color: #e74c3c;
            font-size: 36px;
        }

        p {
            font-size: 18px;
            color: #333;
        }

        .error-icon {
            font-size: 100px;
            color: #e74c3c;
            margin-bottom: 50px;
        }

        .btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 18px;
            color: white;
            background-color: #e74c3c;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #a63024;
            color: #ffffff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="error-icon">✖</div>
    <h1>Ошибка бронирования</h1>
    <p>К сожалению, при обработке вашего заказа произошла ошибка.</p>
    <p>Попробуйте еще раз или свяжитесь с нашей службой поддержки.</p>
    <a href="/" class="btn">Связаться с поддержкой</a>
</div>
</body>
</html>
