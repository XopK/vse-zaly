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
                <h2>Количество активных бронирований</h2>
                <p>{{$bookings->where('is_archive', false)->count()}}</p>
            </div>
            <div class="summary-item">
                <h2>Количество архивных бронирований:</h2>
                <p>{{$bookings->where('is_archive', true)->count()}}</p>
            </div>
        </div>
        <!-- Список залов -->
        <div class="halls-list">
            <h2>Список бронирований</h2>
            @forelse($bookings as $booking)
                <div class="hall">
                    @if($booking->hall)
                        <div class="img">
                            <img src="/storage/photo_halls/{{$booking->hall->preview_hall}}"
                                 alt="{{$booking->hall->preview_hall}}">
                        </div>
                    @endif
                    <div class="hall_info">
                        <h3>Зал: {{$booking->hall->name_hall ?? 'Информация отсутствует'}}</h3>
                        <p>Дата бронирования: {{ date('d.m.Y', strtotime($booking->booking_start)) }}</p>
                        <p>Время бронирования: {{ date('H:i', strtotime($booking->booking_start)) }}
                            - {{ date('H:i', strtotime($booking->booking_end)) }}</p>
                        <p>Создание бронирования: {{ date('d.m.Y H:i', strtotime($booking->created_at)) }}</p>
                        @if($booking->user)
                            <p><a style="text-decoration: none; color: black"
                                  href="/user/{{$booking->user->id}}">{{$booking->user->name}}</a> (<a
                                    style="text-decoration: none; color: black"
                                    href="tel:{{$booking->user->phone}}">{{$booking->user->phone}}</a>)
                            </p>
                            <p>

                                @if($booking->user->email_verified_at)
                                    <a style="text-decoration: none; color: black"
                                       href="mailto:{{ $booking->user->email}}">
                                        {{$booking->user->email}}
                                    </a>
                                @else
                                    Почта не подтверждена!
                                @endif

                            </p>
                        @elseif($booking->unregister_user)
                            <p>{{$booking->unregister_user->name}}(<a
                                    style="text-decoration: none; color: black"
                                    href="tel:{{$booking->unregister_user->phone}}">{{$booking->unregister_user->phone}}</a>
                                ) (Пользователь не зарегистрирован!)</p>

                            <p><a style="text-decoration: none; color: black"
                                  href="mailto:{{ $booking->unregister_user->email}}">
                                    {{$booking->unregister_user->email}}
                                </a></p>
                        @endif

                    </div>
                </div>
            @empty
            @endforelse

        </div>
    </div>
</div>
</body>

</html>
