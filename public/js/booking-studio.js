$(document).ready(function () {
    // Устанавливаем начальное значение количества человек при загрузке страницы
    var initialPeopleCount = $('#peopleCount').find('option:selected').data('count');
    $('#countPeople').val(initialPeopleCount);

    // Выполните все необходимые операции, которые обычно выполняются при изменении выбора
    generateTimeRows();

    // Остальной ваш код...
    $('#peopleCount').change(function () {
        clearBookingForm();
        selectedCells = [];

        var peopleCount = $(this).find('option:selected').data('count');
        $('#countPeople').val(peopleCount);

        $('#weekTable td').removeClass('highlight-cell');
        generateTimeRows();
    });

    moment.locale('ru');
    var weekOffset = 0;
    var selectedCells = [];

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

        var now = moment();
        var startOfWeek = getStartOfWeek(moment().add(weekOffset, 'weeks'));

        var stepMinutes = stepbooking * 60;  // Переводим шаг из часов в минуты
        var startTime = moment(hall.start_time, 'HH:mm');
        var endTime = moment(hall.end_time, 'HH:mm');
        var eveningTime = moment(hall.time_evening, 'HH:mm');

        // Получаем выбранное количество человек
        var peopleCount = parseInt($('#peopleCount').val());

        // Генерация временных строк с учетом шага
        for (var time = startTime.clone(); time.isBefore(endTime); time.add(stepMinutes, 'minutes')) {

            var timeLabel = time.format('HH:mm');
            var row = $('<tr></tr>');
            row.append('<th scope="row" class="sticky-col">' + timeLabel + '</th>');

            for (var i = 0; i < 7; i++) {
                var cell = $('<td data-day-index="' + i + '" data-time="' + timeLabel + '"></td>');
                var cellDateTime = startOfWeek.clone().add(i, 'days').hour(time.hour()).minute(time.minute());

                // Ищем конкретное бронирование для текущей ячейки
                var matchingBooking = bookings.find(function (booking) {
                    var start = moment(booking.booking_start);
                    var end = moment(booking.booking_end);
                    return cellDateTime.isBetween(start, end, null, '[)');
                });

                // Логика для заблокированных ячеек
                if (matchingBooking) {
                    cell.addClass('booked-cell-studio');
                    var userName = matchingBooking.user ? matchingBooking.user.name : 'Неизвестно';
                    var userPhone = matchingBooking.user ? matchingBooking.user.phone : 'Неизвестно';
                    cell.append('<div class="booked-by"><span class="user-name" data-toggle="tooltip" title="' + userPhone + '">' + userName + '</span></div>');
                } else if (cellDateTime.isBefore(now)) {
                    cell.addClass('disabled-past');
                } else {
                    // Если ячейка не заблокирована, добавляем цену
                    var isWeekend = (i === 5 || i === 6); // Суббота и Воскресенье
                    var isEvening = time.isSameOrAfter(eveningTime);
                    var basePrice;

                    if (isWeekend && isEvening) {
                        basePrice = hall.max_price;
                    } else if (isWeekend) {
                        basePrice = hall.price_weekend;
                    } else if (isEvening) {
                        basePrice = hall.price_evening;
                    } else {
                        basePrice = hall.price_weekday;
                    }
                    basePrice -= hall.price_for_studio;
                    // Увеличиваем базовую цену на количество человек
                    var finalPrice = basePrice + peopleCount;

                    cell.append('<div class="price">' + finalPrice + ' ₽</div>');
                }

                row.append(cell);
            }

            tbody.append(row);
        }
    }


    function loadWeek(offset) {
        selectedCells = [];
        $('#weekTable td').removeClass('highlight-cell');

        var startOfWeek = getStartOfWeek(moment().add(offset, 'weeks'));
        var oneMonthLater = moment().add(1, 'month').endOf('day');

        if (startOfWeek.isAfter(oneMonthLater)) {
            alert('Нельзя выбрать дату более чем на один месяц вперёд.');
            return;
        }

        updateWeekDisplay(startOfWeek);
        generateTimeRows();
    }

    function updateSelectedInfo() {
        if (selectedCells.length === 0) {
            $('#selectedDateTime').text('Дата и время: выберите ячейки');
            $('#selectedDate').val('');
            $('#selectedTime').val('');
            $('#totalPrice').val('0');
            $('#totalCost').text('0');
            return;
        }

        var groupedByDay = selectedCells.reduce((acc, cell) => {
            var dayIndex = cell.data('day-index');
            var time = cell.data('time');
            if (!acc[dayIndex]) {
                acc[dayIndex] = [];
            }
            acc[dayIndex].push(cell);
            return acc;
        }, {});

        var startOfWeek = getStartOfWeek(moment().add(weekOffset, 'weeks'));
        var selectedInfo = Object.keys(groupedByDay).map(dayIndex => {
            var cells = groupedByDay[dayIndex];
            var times = cells.map(cell => cell.data('time'));
            times.sort((a, b) => moment(a, 'HH:mm') - moment(b, 'HH:mm'));

            var minTime = times[0];
            var maxTime = times[times.length - 1];

            var maxTimeMoment = moment(maxTime, 'HH:mm');
            maxTimeMoment.add(stepbooking * 60, 'minutes');
            maxTime = maxTimeMoment.format('HH:mm');

            var selectedDay = startOfWeek.clone().add(dayIndex, 'days');
            var selectedDate = selectedDay.format('DD.MM.YYYY');

            return {
                date: selectedDate, timeRange: minTime + ' - ' + maxTime
            };
        });

        // Формирование текста для отображения: Дата: 30.08.2024 (12:00 - 14:00), 31.08.2024 (15:00 - 17:00)
        var dateTimeText = selectedInfo.map(info => `Дата: ${info.date} (${info.timeRange})`).join(', ');

        $('#selectedDateTime').html(dateTimeText);

        // Заполняем скрытые поля для отправки данных
        $('#selectedDate').val(selectedInfo.map(info => info.date).join(', '));
        $('#selectedTime').val(selectedInfo.map(info => info.timeRange).join(', '));

        // Подсчет стоимости
        var totalCost = selectedCells.reduce((total, cell) => {
            var price = parseFloat(cell.find('.price').text().replace('₽', ''));
            return total + price;
        }, 0);

        $('#totalCost').text(totalCost);
        $('#totalPrice').val(totalCost);
    }


    function isCellBetweenSelected(cell) {
        if (selectedCells.length < 2) return false;

        var colIndex = cell.data('day-index');
        var rowIndex = cell.closest('tr').index();

        var selectedRows = selectedCells.filter(c => c.data('day-index') === colIndex).map(c => c.closest('tr').index());

        if (selectedRows.length < 2) return false;

        var minRowIndex = Math.min(...selectedRows);
        var maxRowIndex = Math.max(...selectedRows);

        return rowIndex > minRowIndex && rowIndex < maxRowIndex;
    }

    $('#weekTable').on('click', 'td', function () {
        var cell = $(this);
        if (cell.hasClass('disabled-past') || cell.hasClass('booked-cell-studio')) {
            // Если ячейка в прошлом или забронирована, ничего не делаем
            return;
        }

        var dayIndex = cell.data('day-index');
        var time = cell.data('time');

        if (dayIndex !== undefined && time !== undefined) {
            if (cell.hasClass('highlight-cell')) {
                if (isCellBetweenSelected(cell)) {
                    $('#weekTable td').removeClass('highlight-cell');
                    selectedCells = [];
                } else {
                    cell.removeClass('highlight-cell');
                    selectedCells = selectedCells.filter(c => c.get(0) !== cell.get(0));
                }
            } else {
                cell.addClass('highlight-cell');
                selectedCells.push(cell);
            }

            // Обновляем доступность ячеек
            $('#weekTable td').each(function () {
                var currentCell = $(this);
                var currentColIndex = currentCell.data('day-index');
                var cellDateTime = getStartOfWeek(moment().add(weekOffset, 'weeks'))
                    .add(currentColIndex, 'days')
                    .hour(parseInt(currentCell.data('time')));

                if (!currentCell.hasClass('disabled-past') && !currentCell.hasClass('booked-cell-studio') && cellDateTime.isSameOrAfter(moment())) {
                    currentCell.removeClass('disabled-cell');
                }
            });

            updateSelectedInfo();
        } else {
            console.warn("Cell data is missing 'dayIndex' or 'time'.");
        }
    });

    $(document).keydown(function (e) {
        if (selectedCells.length > 0) {
            var cell = selectedCells[0];
            var colIndex = cell.data('day-index');
            var rowIndex = cell.closest('tr').index();
            var newCell;

            switch (e.key) {
                case "ArrowUp":
                    newCell = cell.closest('tr').prev().children().eq(colIndex);
                    break;
                case "ArrowDown":
                    newCell = cell.closest('tr').next().children().eq(colIndex);
                    break;
                case "ArrowLeft":
                    newCell = cell.closest('table').find('tbody tr').eq(rowIndex).children().eq(colIndex - 1);
                    break;
                case "ArrowRight":
                    newCell = cell.closest('table').find('tbody tr').eq(rowIndex).children().eq(colIndex + 1);
                    break;
            }

            if (newCell && newCell.length > 0 && !newCell.hasClass('disabled-past')) {
                cell.removeClass('highlight-cell');
                newCell.addClass('highlight-cell');
                selectedCells = [newCell];
                updateSelectedInfo();
            }
        }
    });

    function clearBookingForm() {
        $('#totalCost').text('0');
        $('#totalPrice').val('');
        $('#selectedDate').val('');
        $('#selectedTime').val('');
        $('#selectedDateTime').text('Дата и время: выберите ячейки');
    }

    $('#prevWeek').click(function () {
        clearBookingForm();

        var newOffset = weekOffset - 1;
        var newStartOfWeek = getStartOfWeek(moment().add(newOffset, 'weeks'));

        if (newStartOfWeek.isBefore(moment().startOf('isoWeek'))) {
            return false;
        }

        weekOffset = newOffset;
        loadWeek(weekOffset);
    });

    $('#nextWeek').click(function () {
        clearBookingForm();
        weekOffset++;

        var startOfWeek = getStartOfWeek(moment().add(weekOffset, 'weeks'));
        var oneMonthLater = moment().add(1, 'month').endOf('day');  // Добавляем 1 месяц

        // Ограничение: если начало недели больше, чем один месяц от текущей даты, не переключаемся
        if (startOfWeek.isAfter(oneMonthLater)) {
            alert('Нельзя выбрать дату более чем на один месяц вперёд.');
            weekOffset--;  // Отменяем изменение
            return;
        }

        loadWeek(weekOffset);
    });


    $('#currentWeek').click(function () {
        clearBookingForm();
        weekOffset = 0;
        loadWeek(weekOffset);
    });

    $('#saveChanges').click(function () {
        if (selectedCells.length === 0) {
            alert('Пожалуйста, выберите дату и время.');
            return;
        }
        $('#bookingForm').submit();
    });

    loadWeek(weekOffset);
});
