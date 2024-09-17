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
                <p>{{$studios}}</p>
            </div>
            <div class="summary-item">
                <h2>Количество не рассмотренных заявок</h2>
                <p>{{count($requests)}}</p>
            </div>
        </div>
        <!-- Список залов -->
        <div class="halls-list">
            <h2>Список новых студий</h2>
            @forelse($requests as $request)
                <div class="hall" style="justify-content: space-between">
                    <div class="info-req">
                        <div class="hall_info">
                            <h3>Название студии: {{$request->name_studio}}</h3>
                            <p>Почта: {{$request->email}}</p>
                            <p>Адрес студии: {{$request->address}}</p>
                            <p>Имя: {{$request->name}}</p>
                            <p>Телефон: {{$request->phone}}</p>
                        </div>
                    </div>
                    <div class="buttons-denay-apply">
                        <a href="/admin/studio_requests/{{$request->id}}?response=apply" class="btn btn-apply">Принять</a>
                        <a href="/admin/studio_requests/{{$request->id}}?response=deny" class="btn btn-deny">Отклонить</a>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</div>
</body>

</html>
