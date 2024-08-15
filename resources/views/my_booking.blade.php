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
            max-height: 240px;
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
    @if (Auth::user()->id_role == 1)
        <div class="my-address contact-2">
            <h3 class="heading-3">Мои брони</h3>
            <ul class="booking-list">
                <li>
                    <a href="hall">
                        <div class="booking_photo">
                            <img src="/images/halls/IMG_5441.jpeg" alt="Фото зала">
                        </div>
                    </a>
                    <div class="booking_info">
                        <h4>Название зала: Зал для конференций</h4>
                        <p>Дата бронирования: 2023-07-16</p>
                        <p>Время: 10:00 - 14:00</p>
                        <a href="/delete_booking">
                            <button>Отменить бронь</button>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    @endif
    @if (Auth::user()->id_role == 2)
        <div class="my-address contact-2">
            <h3 class="heading-3">Активные брони</h3>
            <ul class="booking-list">
                <li>
                    <a href="hall">
                        <div class="booking_photo">
                            <img src="/images/halls/IMG_5441.jpeg" alt="Фото зала">
                        </div>
                    </a>
                    <div class="booking_info">
                        <h4>Название зала: Зал для конференций</h4>
                        <p>Дата бронирования: 2023-07-16</p>
                        <p>Время: 10:00 - 14:00</p>
                        <p>Кто бронировал</p>
                        <a href="/delete_booking">
                            <button>Отменить бронь</button>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
        <h3 class="heading-3">Архив бронирований</h3>
        <ul class="booking-list">
            <li>
                <a href="hall">
                    <div class="booking_photo">
                        <img src="/images/halls/IMG_5441.jpeg" alt="Фото зала">
                    </div>
                </a>
                <div class="booking_info">
                    <h4>Название зала: Зал белый</h4>
                    <p>Дата бронирования: 2023-02-23</p>
                    <p>Время: 17:00 - 21:00</p>
                    <p>Кто бронировал</p>
                </div>
            </li>
        </ul>
    @endif
    <!-- User page end -->
</x-profile>
