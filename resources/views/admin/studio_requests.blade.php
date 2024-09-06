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
                <li><a href="/admin/studio_requests">Заявки от студий</a></li>
            </ul>
        </nav>
        <!-- Контент -->
        <div class="content">
            <!-- Общая информация -->
            <div class="summary">
                <div class="summary-item">
                    <h2>Сколько всего у нас студий:</h2>
                    <p>41</p>
                </div>
                <div class="summary-item">
                    <h2>Количество не рассмотренных заявок</h2>
                    <p>3</p>
                </div>
            </div>
            <!-- Список залов -->
            <div class="halls-list">
                <h2>Список новых студий</h2>
                <div class="hall">
                    <div class="hall_info">
                        <h3>Название студии: </h3>
                        <p>Почта: </p>
                        <p>Адрес студии: </p>
                        <p>Имя: </p>
                        <p>Телефон: </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>

</html>
