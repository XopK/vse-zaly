<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Сброс пароля</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap');

        body {
            font-family: "Play", sans-serif;
            color: #000000;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #1b1c1e;
            /* Добавление рамки */
            text-align: center;
            /* Центрирование содержимого */
        }

        h1 {
            color: #000000;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Сброс пароля</h1>
        <p>Для сброса пароля перейдите по следующей ссылке:</p>
        <a href="{{ $resetLink }}">Сбросить пароль</a>
    </div>
</body>

</html>
