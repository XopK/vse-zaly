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
        <h3 class="heading-3">Мои брони</h3>
        <ul class="booking-list">
            @if (session('error_delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('error_delete') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('success_delete'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success_delete') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @forelse($bookings_user as $user)
                <li>
                    <a href="/hall/{{$user->hall->id}}-{{Str::slug($user->hall->name_hall)}}">
                        <div class="booking_photo">
                            <img src="/storage/photo_halls/{{$user->hall->preview_hall}}"
                                 alt="{{$user->hall->preview_hall}}" title="{{$user->hall->name_hall}}">
                        </div>
                    </a>
                    <div class="booking_info">
                        <h4>{{$user->hall->name_hall}}</h4>
                        <p>Дата бронирования: {{ date('d.m.Y', strtotime($user->booking_start)) }}</p>
                        <p>Время: {{ date('H:i', strtotime($user->booking_start)) }}
                            - {{ date('H:i', strtotime($user->booking_end)) }}</p>
                        @if($user->payment_id)
                            <form action="/delete_booking/{{$user->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Отменить бронь</button>
                            </form>
                        @endif
                        @if($user->link_payment)
                            <a href="{{$user->link_payment}}" class="theme-btn btn-style-one mt-3"><span
                                    class="btn-title">Продолжить оплату</span></a>
                        @endif
                    </div>
                </li>
            @empty
                <div class="alert alert-warning" role="alert">
                    У вас нет броней.
                </div>
            @endforelse

        </ul>
    </div>
    @if (Auth::user()->id_role == 2)
        <div class="my-address contact-2">
            <h3 class="heading-3">Активные брони{{count($active_bookings) ? ': ' . count($active_bookings) : '' }}</h3>
            <ul class="booking-list">
                @if (session('error_delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error_delete') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('success_delete'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success_delete') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @forelse($active_bookings as $active)
                    <li>


                        <div class="booking_info">
                            <a href="/hall/{{$active->hall->id}}-{{Str::slug($active->hall->name_hall)}}">
                                <h4>{{$active->hall->name_hall}}</h4>
                            </a>
                            <p>Дата бронирования: {{ date('d.m.Y', strtotime($active->booking_start)) }}</p>
                            <p>Время бронирования: {{ date('H:i', strtotime($active->booking_start)) }}
                                - {{ date('H:i', strtotime($active->booking_end)) }}</p>
                            <p>Создание бронирования: {{ date('d.m.Y H:i', strtotime($active->created_at)) }}</p>
                            @if($active->user)
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
                            @elseif($active->unregister_user)
                                <p><strong>{{$active->unregister_user->name}}(<a
                                            href="tel:{{$active->unregister_user->phone}}">{{$active->unregister_user->phone}}</a>)</strong>
                                </p>
                                <p>
                                    <strong>
                                        @if($active->unregister_user->email)
                                            <a href="mailto:{{ $active->unregister_user->email }}">{{ $active->unregister_user->email }}</a>
                                        @else
                                            Почта не указана!
                                        @endif
                                    </strong>
                                </p>
                            @endif

                            <form action="/delete_booking/{{$active->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Отменить бронь</button>
                            </form>
                        </div>
                    </li>
                @empty
                    <div class="alert alert-warning" role="alert">
                        У вас нет активных броней
                    </div>
                @endforelse
            </ul>
        </div>
        <h3 class="heading-3">Архив
            бронирований{{count($archived_bookings) ? ': ' . count($archived_bookings) : '' }}</h3>
        <ul class="booking-list">
            @forelse($archived_bookings as $archive)
                <li>
                    <div class="booking_info">
                        <a href="/hall/{{$archive->hall->id}}-{{Str::slug($archive->hall->name_hall)}}">
                            <h4>{{$archive->hall->name_hall}}</h4>
                        </a>
                        <p>Дата бронирования: {{ date('d.m.Y', strtotime($archive->booking_start)) }}</p>
                        <p>Время бронирования: {{ date('H:i', strtotime($archive->booking_start)) }}
                            - {{ date('H:i', strtotime($archive->booking_end)) }}</p>
                        <p>Создание бронирования: {{ date('d.m.Y H:i', strtotime($archive->created_at)) }}</p>
                        @if($archive->user)
                            <p><strong><a href="/user/{{$archive->user->id}}">{{$archive->user->name}}</a> (<a
                                        href="tel:{{$archive->user->phone}}">{{$archive->user->phone}}</a>)</strong>
                            </p>
                            <p>
                                <strong>
                                    @if($archive->user->email_verified_at)
                                        <a href="mailto:{{ $archive->user->email}}">
                                            {{$archive->user->email}}
                                        </a>
                                    @else
                                        <a href="mailto:{{ $archive->user->email}}">
                                            {{$archive->user->email}} (почта не подтверждена!)
                                        </a>
                                    @endif
                                </strong>
                            </p>
                        @elseif($archive->unregister_user)
                            <p><strong>{{$archive->unregister_user->name}}(<a
                                        href="tel:{{$archive->unregister_user->phone}}">{{$archive->unregister_user->phone}}</a>)</strong>
                            </p>
                            <p>
                                <strong>
                                    @if($archive->unregister_user->email)
                                        <a href="mailto:{{ $archive->unregister_user->email }}">{{ $archive->unregister_user->email }}</a>
                                    @else
                                        Почта не указана!
                                    @endif
                                </strong>
                            </p>
                        @endif
                    </div>
                </li>
            @empty
                <div class="alert alert-warning" role="alert">
                    У вас нет архивных броней
                </div>
            @endforelse

        </ul>
    @endif
    <!-- User page end -->
</x-profile>
