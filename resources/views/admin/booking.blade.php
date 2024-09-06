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
                    <h2>Количество активных бронирований</h2>
                    <p>20</p>
                </div>
                <div class="summary-item">
                    <h2>Количество архивных бронирований:</h2>
                    <p>1500</p>
                </div>
            </div>
            <!-- Список залов -->
            <div class="halls-list">
                <h2>Список бронирований</h2>
                <div class="hall">
                    <div class="img">
                        <img src="/images/halls/IMG_4036.jpeg" alt="упс">
                    </div>
                    <div class="hall_info">
                        <h3>Зал: Белый</h3>
                        <p>Дата бронирования: 30.08.2024</p>
                        <p>Время бронирования: 18:00 - 18:30</p>
                        <p>Создание бронирования: 30.08.2024 10:33</p>
                        <p>Арслан (+79991314324)</p>
                        <p>Почта не подтверждена!</p>
                    </div>
                </div>
                <div class="hall">
                    <div class="img">
                        <img src="/images/halls/IMG_4036.jpeg" alt="упс">
                    </div>
                    <div class="hall_info">
                        <h3>Зал: черный</h3>
                        <p>Дата бронирования: 31.08.2024</p>
                        <p>Время бронирования: 18:00 - 18:30</p>
                        <p>Создание бронирования: 30.08.2024 10:33</p>
                        <p>Арслан (+79991314324)</p>
                        <p>Почта не подтверждена!</p>
                    </div>
                </div>
                <div class="hall">
                    <div class="img">
                        <img src="/images/halls/IMG_4036.jpeg" alt="упс">
                    </div>
                    <div class="hall_info">
                        <h3>Зал: Белый</h3>
                        <p>Дата бронирования: 30.08.2024</p>
                        <p>Время бронирования: 18:00 - 18:30</p>
                        <p>Создание бронирования: 30.08.2024 10:33</p>
                        <p>Арслан (+79991314324)</p>
                        <p>Почта не подтверждена!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
