$(document).ready(function () {

    // Фильтрация по цене, площади, студии и названию (клиентская)
    function clientSideFilter() {
        let search = $('input[type="search"]').val().toLowerCase();  // Поиск по названию зала
        let price = $('#price').val();  // Максимальная цена
        let minArea = $('#area').val();  // Минимальная площадь
        let studio = $('#selectThis').val();  // Студия

        $('.hall-item').each(function () {
            let hallName = $(this).data('name');
            let hallPrice = $(this).data('price');
            let hallArea = $(this).data('area');
            let hallStudio = $(this).data('studio');  // Слуг студии

            // Проверка условий: цена <= выбранной, площадь >= минимальной, поиск по имени и студии
            if (hallPrice <= price && hallArea <= minArea && hallName.includes(search) && (studio === '' || hallStudio === studio)) {
                if (!$(this).is(':visible')) {
                    $(this).stop(true, true).fadeIn(400);  // Плавное появление
                }
            } else {
                if ($(this).is(':visible')) {
                    $(this).stop(true, true).fadeOut(400);  // Плавное исчезновение
                }
            }
        });
    }

    // Клиентская фильтрация при изменении параметров
    $('input[type="search"], #price, #area, #selectThis').on('input change', function () {
        clientSideFilter();
    });

    // Серверная фильтрация по дате и времени (AJAX)
    function fetchServerFilteredHalls() {
        let filters = {
            date: $('#date').val(), time: $('#timeThis').val(),
        };

        $.ajax({
            url: "/halls/filter", method: "GET", data: filters, success: function (response) {
                // Обновляем список залов по результатам фильтрации на сервере
                $('.hall-item').each(function () {
                    let hallId = $(this).data('id');
                    // Скрываем залы, которые не вернулись с сервера
                    if (!response.some(hall => hall.id == hallId)) {
                        $(this).hide();
                    }
                });
                clientSideFilter(); // Применяем клиентские фильтры
            }, error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    // Серверная фильтрация при изменении даты и времени
    $('#date, #timeThis').on('change', function () {
        fetchServerFilteredHalls();
    });

    // Изначальная фильтрация (например, при загрузке страницы)
    clientSideFilter();
});
