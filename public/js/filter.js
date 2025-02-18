$(document).ready(function () {
    let typingTimer;
    const typingInterval = 400;
    let previousFilters = {};
    let previousContent = ''; // Переменная для хранения предыдущего содержимого залов

    // Функция для обновления списка залов
    function fetchServerFilteredHalls(page = 1, updateUrl = true) {
        let filters = {
            search: $('input[type="search"]').val().trim(),
            date: $('#date').val(),
            time: $('#timeThis').val(),
            min_price: $('#min-price').val(),
            max_price: $('#max-price').val(),
            min_area: $('#min-area').val(),
            max_area: $('#max-area').val(),
            studio: $('#selectThis').val(),
            sort: $('.cd-filters .filter .selected').parent().data('filter'),
            page: page // Добавляем номер страницы
        };

        // Проверяем, изменились ли фильтры
        if (JSON.stringify(filters) === JSON.stringify(previousFilters)) {
            return; // Если фильтры не изменились, не отправляем запрос
        }

        previousFilters = filters;

        $.ajax({
            url: "/halls/filter", method: "GET", data: filters, beforeSend: function () {
                $('#halls-container').fadeOut(300);
            }, success: function (response) {

                if (response.html !== previousContent) {
                    previousContent = response.html; // Обновляем предыдущий контент
                    $('#halls-container').html(response.html);
                    $('#halls-container').fadeIn(300);
                    $('.hall-item').hide().each(function (index) {
                        $(this).delay(100 * index).fadeIn(300);
                    });
                    $('#pagination-container').html(response.pagination); // Обновляем пагинацию

                    // Прокрутка вверх страницы
                    window.scrollTo({top: 0, behavior: 'smooth'});

                    // Обновляем URL
                    if (updateUrl) {
                        const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=' + page;
                        window.history.pushState({path: newUrl}, '', newUrl);
                    }
                } else {
                    $('#halls-container').fadeIn(300); // Простой fadeIn без анимации
                }
            }, error: function (xhr) {
                $('#halls-container').fadeIn(300); // В случае ошибки показываем старые данные
            }
        });
    }

    function updatePriceValues() {
        let minPrice = parseInt($('#min-price').val());
        let maxPrice = parseInt($('#max-price').val());

        // Если минимальная цена больше максимальной, сдвигаем максимальную цену
        if (minPrice > maxPrice) {
            $('#max-price').val(minPrice); // Автоматически сдвигаем максимальную цену
            $('#max-price-value').text(minPrice); // Обновляем значение ползунка
        } else if (maxPrice < minPrice) {
            $('#min-price').val(maxPrice);
            $('#min-price-value').text(maxPrice);
        }

        clearTimeout(typingTimer);
        typingTimer = setTimeout(fetchServerFilteredHalls, typingInterval);
    }

    function updateAreaValues() {
        let minArea = parseInt($('#min-area').val());
        let maxArea = parseInt($('#max-area').val());

        if (minArea > maxArea) {
            $('#max-area').val(minArea);
            $('#max-area-value').text(minArea);
        } else if (maxArea < minArea) {
            $('#min-area').val(maxArea);
            $('#min-area-value').text(maxArea);
        }

        clearTimeout(typingTimer);
        typingTimer = setTimeout(fetchServerFilteredHalls, typingInterval);
    }

    // Обработчики событий для текстовых полей
    $('input[type="search"]').on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(fetchServerFilteredHalls, typingInterval);
    });

    // Обработчики событий для фильтров типа range
    $('#min-price, #max-price').on('change', updatePriceValues);

    $('#min-area, #max-area').on('change', updateAreaValues);

    // Обработчики событий для выпадающих списков и даты
    $('#selectThis, #date, #timeThis').on('change', function () {
        fetchServerFilteredHalls();
    });

    // Обработчик событий для кнопок фильтров
    $('.filter').on('click', function (e) {
        e.preventDefault();
        $('.filter a').removeClass('selected');
        $(this).find('a').addClass('selected');
        fetchServerFilteredHalls();
    });

    // Обработчик кликов по ссылкам пагинации
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();

        let page = $(this).attr('href').split('page=')[1]; // Получаем номер страницы из URL

        fetchServerFilteredHalls(page, true); // Загружаем залы для выбранной страницы и обновляем URL
    });

    // Изначальная загрузка данных
    fetchServerFilteredHalls();
});
