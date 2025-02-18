<x-userlayout :user="$user">
    <style>
        .booking-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .booking-list li {
            display: flex;
            background: #f9f9f9;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .booking_info h4 {
            margin: 0 0 5px;
        }

        .booking_info p {
            margin: 0;
        }

        .booking_photo {
            max-width: 240px;
            max-height: 270px;
            padding-right: 20px;

        }

        .booking_info button {
            margin-top: 10px;
            padding: 10px;
            color: white;
            background-color: black;
            border: 1px solid black;
            transition: background-color 0.3s, color 0.3s;
        }

        .booking_info button:hover {
            margin-top: 10px;
            padding: 10px;
            color: rgb(0, 0, 0);
            background-color: rgb(255, 255, 255);
            border: 1px solid black;
            transition: background-color 0.3s, color 0.3s;
        }
    </style>
    <div class="my-address contact-2">
        <h3 class="heading-3">Бронирования</h3>
        <ul class="booking-list">
            @forelse($bookings as $active)
                <li>
                    <div class="booking_info">
                        <a href="/hall/{{$active->hall->id}}-{{Str::slug($active->hall->name_hall)}}">
                            <h4>{{$active->hall->name_hall}}</h4>
                        </a>
                        <p>Дата бронирования: {{ date('d.m.Y', strtotime($active->booking_start)) }}</p>
                        <p>Время бронирования: {{ date('H:i', strtotime($active->booking_start)) }}
                            - {{ date('H:i', strtotime($active->booking_end)) }}</p>
                        <p>Создание бронирования: {{ date('d.m.Y H:i', strtotime($active->created_at)) }}</p>
                        @php
                            $statusLabels = [
                                'MANUAL_BOOKING' => 'Зарезервировано с помощью владельца',
                                'CONFIRMED' => 'Оплачено',
                                'AUTHORIZED' => 'Авторизован',
                                'NEW' => 'Не оплачен'
                            ];
                        @endphp
                        <p>Статус бронирования: {{ $statusLabels[$active->status_payment] ?? 'Неизвестный статус' }}</p>
                        <p><strong><a href="/user/{{$active->user->id}}">{{$active->user->name}}</a> (<a
                                    href="tel:{{$active->user->phone}}">{{$active->user->phone}}</a>)</strong>
                        </p>
                        <p>
                            <strong>
                                @if($active->user->email_verified_at)
                                    <a href="mailto:{{ $active->user->email}}">
                                        {{$active->user->email}}
                                    </a>
                                @else
                                    <a href="mailto:{{ $active->user->email}}">
                                        {{$active->user->email}} (почта не подтверждена!)
                                    </a>
                                @endif
                            </strong>
                        </p>
                    </div>
                </li>
            @empty
            @endforelse
        </ul>
    </div>
</x-userlayout>
