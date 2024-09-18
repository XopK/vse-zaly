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
            <li><a href="{{ route('logout') }}">Выйти</a></li>
        </ul>
    </nav>
    <!-- Контент -->
    <div class="content">
        <!-- Общая информация -->
        <div class="summary">
            <div class="summary-item">
                <h2>Сколько всего студий:</h2>
                <p>{{count($studios)}}</p>
            </div>

        </div>
        <!-- Список залов -->
        <div class="halls-list">
            <h2>Список студий</h2>
            @forelse($studios as $studio)
                <div class="hall">
                    <div class="img">
                        <img src="/storage/photo_studios/{{$studio->photo_studio}}" alt="{{$studio->photo_studio}}">
                    </div>

                    <div class="hall_info">
                        <h3>Студия: {{$studio->name_studio}}</h3>
                        <p>владелец: {{$studio->owner->name}}</p>
                        <p>адрес: {{$studio->adress_studio}}</p>
                        <p>номер телефона: {{$studio->phone_studio}}</p>
                        <p>сколько залов: {{$studio->halls->count()}}</p>
                        <p>сколько раз у студии бронировали: {{ $studio->halls->sum('count_booking') }}</p>
                    </div>
                </div>
            @empty

            @endforelse

        </div>
    </div>
</div>
</body>

</html>
