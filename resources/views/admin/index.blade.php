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
    <nav class="sidebar">
        <ul>
            <li><a href="/admin">Главная</a></li>
            <li><a href="/admin/studios">Студии</a></li>
            <li><a href="/admin/users">Пользователи</a></li>
            <li><a href="/admin/booking">Бронирования</a></li>
            <li><a href="/admin/studio_requests">Заявки от студий</a></li>
            <li><a href="{{ route('logout') }}">Выйти</a></li>
        </ul>
    </nav>
    <!-- Контент -->
    <div class="content">
        <!-- Общая информация -->
        <div class="summary">
            <div class="summary-item">
                <h2>Общая цена за все залы:</h2>
                <p>{{$halls->sum('total_income')}} ₽</p>
            </div>
            <div class="summary-item">
                <h2>Количество бронирований:</h2>
                <p>{{$halls->sum('count_booking')}} раз</p>
            </div>
        </div>
        <div class="halls-list">
            <h2>Список залов</h2>
            @forelse($halls as $hall)
                <div class="hall">
                    <div class="img">
                        <img src="/storage/photo_halls/{{$hall->preview_hall}}" alt="{{$hall->preview_hall}}">
                    </div>
                    <div class="hall_info">
                        <h3>Названия зала: {{$hall->name_hall}}</h3>
                        <p class="truncate">Описание зала: {{$hall->description_hall}}</p>
                        <p>Цена: {{$hall->total_income}} ₽</p>
                        <p>Бронирования: {{$hall->count_booking }}</p>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</div>
</body>

</html>
