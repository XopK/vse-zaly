$(document).ready(function () {
    moment.locale('ru');
    var weekOffset = 0;
    var selectedDate;
    var selectedTime;

    function getStartOfWeek(date) {
        return date.clone().startOf('isoWeek');
    }

    function updateWeekDisplay(startOfWeek) {
        var endOfWeek = startOfWeek.clone().endOf('isoWeek');
        var currentMonth = startOfWeek.format('MMMM YYYY');

        $('#currentMonth').text(currentMonth);
        $('#weekRange').text(startOfWeek.format('DD.MM') + ' - ' + endOfWeek.format('DD.MM'));

        var days = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
        var today = moment().startOf('day');
        var todayIndex = -1;

        $('.day').each(function (index) {
            var currentDay = startOfWeek.clone().add(index, 'days');
            $(this).html(days[index] + ' <br> ' + currentDay.format('DD.MM'));

            if (currentDay.isSame(today, 'day')) {
                todayIndex = index;
            }
        });

        $('.day').removeClass('highlight-today');
        if (todayIndex !== -1) {
            $('.day').eq(todayIndex).addClass('highlight-today');
        }
    }

    function generateTimeRows() {
        var tbody = $('#weekTable tbody');
        tbody.empty();

        // Генерация временных строк с часовыми интервалами
        for (var hour = 9; hour <= 22; hour++) {
            var timeLabel = hour + ':00';
            var row = $('<tr></tr>');
            row.append('<th scope="row" class="sticky-col">' + timeLabel + '</th>');

            for (var i = 0; i < 7; i++) {
                row.append('<td data-day-index="' + i + '" data-time="' + timeLabel + '"></td>');
            }

            tbody.append(row);
        }
    }

    function loadWeek(offset) {
        var startOfWeek = getStartOfWeek(moment().add(offset, 'weeks'));
        updateWeekDisplay(startOfWeek);
        generateTimeRows();
    }

    $('#weekTable').on('click', 'td', function () {
        var cell = $(this);
        var dayIndex = cell.data('day-index');
        var time = cell.data('time');

        if (dayIndex !== undefined && time !== undefined) {
            var startOfWeek = getStartOfWeek(moment().add(weekOffset, 'weeks'));
            var selectedDay = startOfWeek.clone().add(dayIndex, 'days');
            selectedDate = selectedDay.format('DD.MM.YYYY');
            selectedTime = time;

            $('#selectedDate').text('Дата: ' + selectedDate);
            $('#selectedTime').text('Время: ' + selectedTime);
            $('.booking-form').show(); // Показываем форму бронирования
        }
    });

    $('#confirmBooking').click(function () {
        if (selectedDate && selectedTime) {
            $.ajax({
                url: '/booking',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF-токен
                    date: selectedDate,
                    time: selectedTime
                },
                success: function (response) {
                    alert('Бронирование успешно!');
                    $('.booking-form').hide(); // Скрываем форму бронирования
                },
                error: function () {
                    alert('Ошибка при бронировании. Попробуйте снова.');
                }
            });
        }
    });

    $('#prevWeek').click(function () {
        weekOffset--;
        loadWeek(weekOffset);
    });

    $('#nextWeek').click(function () {
        weekOffset++;
        loadWeek(weekOffset);
    });

    $('#currentWeek').click(function () {
        weekOffset = 0;
        loadWeek(weekOffset);
    });

    loadWeek(weekOffset);
});
