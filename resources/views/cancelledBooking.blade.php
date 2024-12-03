<x-profile>
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

    <!-- User page start -->

    <div class="my-address contact-2">
        <h3 class="heading-3">Отмененные брони</h3>
        <ul class="booking-list">
            @forelse($cancelled as $user)
                <li>
                    <div class="booking_info">
                        <a href="/hall/{{$user->hall->id}}-{{Str::slug($user->hall->name_hall)}}">
                            <h4>{{$user->hall->name_hall}}</h4>
                        </a>
                        <p>Дата бронирования: {{ date('d.m.Y', strtotime($user->booking_start)) }}</p>
                        <p>Время: {{ date('H:i', strtotime($user->booking_start)) }}
                            - {{ date('H:i', strtotime($user->booking_end)) }}</p>
                        <p>Дата и время
                            отмены: {{ date('d.m.Y', strtotime($user->created_at)) }} {{ date('H:i', strtotime($user->created_at)) }}</p>
                        <p><strong>
                                Клиент: {{$user->user ? $user->user->name . ' (' . $user->user->phone . ')' : $user->unregisteredUser->name . ' (' . $user->unregisteredUser->phone . ')'}} </strong>
                        </p>

                        <p><strong>{{$user->user ? $user->user->email : $user->unregisteredUser->email}}</strong>
                        </p>
                    </div>
                </li>
            @empty
                <div class="alert alert-warning" role="alert">
                    У вас нет броней.
                </div>
            @endforelse

        </ul>
    </div>
    <!-- User page end -->
</x-profile>
