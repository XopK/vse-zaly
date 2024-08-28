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
            </ul>
        </nav>
        <!-- Контент -->
        <div class="content">
            <!-- Общая информация -->
            <div class="summary">
                <div class="summary-item">
                    <h2>Общая цена за все залы:</h2>
                    <p>200 000 ₽</p>
                </div>
                <div class="summary-item">
                    <h2>Количество бронирований:</h2>
                    <p>150 раз</p>
                </div>
            </div>
            <!-- Список залов -->
            <div class="halls-list">
                <h2>Список залов</h2>
                <div class="hall">
                    <div class="img">
                        <img src="/images/halls/IMG_4036.jpeg" alt="упс">
                    </div>
                    <div class="hall_info">
                        <h3>Зал 1</h3>
                        <p>Краткое описание зала 1</p>
                        <p>Цена: 50 000 ₽</p>
                        <p>Бронирования: 30 раз</p>
                    </div>
                </div>
                <div class="hall">
                    <div class="img">
                        <img src="/images/halls/IMG_4036.jpeg" alt="упс">
                    </div>
                    <div class="hall_info">
                        <h3>Зал 2</h3>
                        <p>Краткое описание зала 2</p>
                        <p>Цена: 60 000 ₽</p>
                        <p>Бронирования: 40 раз</p>
                    </div>
                </div>
                <div class="hall">
                    <div class="img">
                        <img src="/images/halls/IMG_4036.jpeg" alt="упс">
                    </div>
                    <div class="hall_info">
                        <h3>Зал 3</h3>
                        <p>Краткое описание зала 3</p>
                        <p>Цена: 70 000 ₽</p>
                        <p>Бронирования: 50 раз</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
