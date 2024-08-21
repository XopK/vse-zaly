<x-profile>
    <style>
        .booking-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .booking-list li {
            background: #f9f9f9;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .booking-list h4 {
            margin: 0 0 5px;
        }

        .booking-list p {
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

        /* Контейнер для сердечка */
        .heart-container {
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-top: -30px;
        }

        /* Основные стили для сердечка */
        .heart {
            width: 24px;
            height: 24px;
            position: relative;
            background-color: black;
            /* Цвет сердечка до изменения */
            transform: rotate(315deg);
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin: 15px;

        }

        /* Левая половинка сердечка */
        .heart::before,
        .heart::after {
            content: "";
            position: absolute;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: black;
            /* Цвет сердечка до изменения */
            transition: background-color 0.3s ease;
        }

        /* Позиционирование левой половинки */
        .heart::before {
            top: -12px;
            left: 0;
        }

        /* Позиционирование правой половинки */
        .heart::after {
            left: 12px;
            top: 0;
        }

        /* Эффект изменения цвета и увеличения при клике */
        .heart-container.active .heart,
        .heart-container:hover .heart {
            background-color: red;
            /* Цвет сердечка после изменения */
            transform: rotate(315deg) scale(1.2);
            /* Немного увеличиваем сердечко */
        }

        .heart-container.active .heart::before,
        .heart-container.active .heart::after,
        .heart-container:hover .heart::before,
        .heart-container:hover .heart::after {
            background-color: red;
            /* Цвет сердечка после изменения */
        }

        .booking-list li {
            display: flex;
        }
    </style>
    <div class="my-address contact-2">
        <h3 class="heading-3">Мои залы</h3>
        <div class="d-flex justify-content-between">
            <h5 class="heading-3">Общий доход: {{$sum_income}} ₽</h5>
            <h5 class="heading-3">Кол-во бронирований: {{$total_count_booking}}</h5>
        </div>
        <ul class="booking-list">
            @forelse($halls as $hall)
                <li>
                    <a href="/my_hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}">
                        <div class="booking_photo">
                            <img src="/storage/photo_halls/{{$hall->preview_hall}}" alt="{{$hall->preview_hall}}"
                                 title="{{$hall->name_hall}}">
                        </div>

                    </a>
                    <div class="booking_info">
                        <h4>{{$hall->name_hall}}</h4>
                        <p>Всего бронировали: {{$hall->count_booking}}</p>
                        <p>Доход: {{$hall->total_income}} ₽</p>
                        <p>Просмотры: {{$hall->view_count}}</p>
                    </div>

                </li>
            @empty
            @endforelse

        </ul>
    </div>
</x-profile>
<script>
    document.querySelector('.heart-container').addEventListener('click', function () {
        this.classList.toggle('active');
    });
</script>
