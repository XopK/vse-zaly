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
        <h3 class="heading-3">Избранные залы</h3>
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

                </div>
                <div class="heart-container">
                    <div class="heart"></div>
                    <p>Удалить из избранного</p>
                </div>
            </li>
        </ul>
    </div>
</x-profile>
<script>
    document.querySelector('.heart-container').addEventListener('click', function () {
        this.classList.toggle('active');
    });
</script>