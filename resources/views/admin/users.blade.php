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
                <h2>Сколько всего пользователей:</h2>
                <p>{{count($users)}}</p>
            </div>

        </div>
        <!-- Список залов -->
        <div class="halls-list">
            <h2>Список пользователей</h2>
            @forelse($users as $user)
                <a href="/user/{{$user->id}}" style="text-decoration: none">
                    <div class="hall">
                        <div class="img">
                            <img src="/storage/users_profile/{{$user->photo_profile}}" alt="{{$user->photo_profile}}">
                        </div>
                        <div class="hall_info">
                            <h3>{{$user->name}}</h3>
                            <p>Сколько раз бронировал: {{$user->booking->count()}}</p>
                            <p>Инстаграм: {{$user->instagram ? $user->instagram : 'Отсутствует'}}</p>
                            <p>Телеграм: {{$user->telegram ? $user->telegram : 'Отсутствует'}}</p>
                            <p>Вк: {{$user->vk ? $user->vk : 'Отсутствует'}}</p>
                            <p>Номер телефона: {{$user->phone}}</p>
                            <p>Почта: {{$user->email}}</p>
                        </div>
                    </div>
                </a>

            @empty
            @endforelse
            
        </div>
    </div>
</div>
</body>

</html>
