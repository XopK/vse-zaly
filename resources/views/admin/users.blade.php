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
                    <h2>Сколько всего пользователей:</h2>
                    <p>10 000</p>
                </div>
                
            </div>
            <!-- Список залов -->
            <div class="halls-list">
                <h2>Список пользователей</h2>
                <div class="hall">
                    <div class="img">
                        <img src="/images/halls/IMG_4036.jpeg" alt="упс">
                    </div>
                    <div class="hall_info">
                        <h3>Иванов иван жесткович</h3>
                        <p>Сколько раз бронировал: 42</p>
                        <p>Инста</p>
                        <p>Телега</p>
                        <p>вк</p>
                        <p>номер телефона</p>
                        <p>почта</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>

</html>
