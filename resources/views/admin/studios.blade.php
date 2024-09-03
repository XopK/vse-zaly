<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель</title>
    <link rel="stylesheet" href="/css/styless.css">
</head>

<body>
    <div class="admin-panel">
        <!-- Панель навигации -->
        <nav class="sidebar">
            <ul>
                <li><a href="/admin">Главная</a></li>
                <li><a href="/admin/studios">Студии</a></li>
                <li><a href="/admin/users">Пользователи</a></li>
                <li><a href="/admin/booking">Бронирования</a></li>
            </ul>
        </nav>
        <!-- Контент -->
        <div class="content">
            <!-- Общая информация -->
            <div class="summary">
                <div class="summary-item">
                    <h2>Сколько всего студий:</h2>
                    <p>250</p>
                </div>
                
            </div>
            <!-- Список залов -->
            <div class="halls-list">
                <h2>Список студий</h2>
                <div class="hall">
                    <div class="img">
                        <img src="/images/halls/IMG_4036.jpeg" alt="упс">
                    </div>
                    <div class="hall_info">
                        <h3>Студия: Brain</h3>
                        <p>владелец</p>
                        <p>Адрес</p>
                        <p>владелец</p>
                        <p>номер тлф</p>
                        <p>сколько залов</p>
                        <p>сколько раз у студии бронировали</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>

</html>
