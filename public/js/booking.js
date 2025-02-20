$(document).ready(function () {
    var initialIdPrice = $('#peopleCount').find('option:selected').val();
    $('#idPriceHall').val(initialIdPrice);

    generateTimeRows();


    function showAlert(message, type = 'success') {
        // Создаем HTML-разметку для сообщения
        const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            <strong>${message}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `;
        // Вставляем сообщение в контейнер
        $('.alert-container').html(alertHtml);

        setTimeout(() => {
            $('.alert-container .alert').alert('close');
        }, 10000);
    }

    $('#peopleCount').change(function () {
        var selectedId = $(this).find('option:selected').val();
        $('#idPriceHall').val(selectedId);

        var minPeople = $(this).find('option:selected').data('min_people');
        var maxPeople = $(this).find('option:selected').data('max_people');

        var selectedPriceRange = hallPrices.find(function (price) {
            return minPeople >= price.min_people && maxPeople <= price.max_people;
        });

        if (selectedPriceRange) {
            hall.price_weekday = selectedPriceRange.weekday_price;
            hall.price_evening = selectedPriceRange.weekday_evening_price;
            hall.price_weekend = selectedPriceRange.weekend_price;
            hall.price_weekend_evening = selectedPriceRange.weekend_evening_price;
        } else {
            console.error('No price range found for this people count.');
        }

        // Сохраняем выбранные ячейки перед перегенерацией
        var previouslySelectedCells = selectedCells.map(function (cell) {
            return {
                dayIndex: cell.data('day-index'), time: cell.data('time')
            };
        });

        // Перегенерация строк с новыми ценами
        generateTimeRows();

        // Восстанавливаем выделенные ячейки
        selectedCells = [];
        previouslySelectedCells.forEach(function (savedCell) {
            var cellToSelect = $('#weekTable td[data-day-index="' + savedCell.dayIndex + '"][data-time="' + savedCell.time + '"]');
            if (cellToSelect.length > 0) {
                cellToSelect.addClass('highlight-cell');
                selectedCells.push(cellToSelect);
            }
        });

        // Применяем логику блокировки столбцов
        if (selectedCells.length > 0) {
            var selectedRows = selectedCells.map(c => c.closest('tr').index());
            var minRowIndex = Math.min(...selectedRows);
            var maxRowIndex = Math.max(...selectedRows);

            $('#weekTable td').each(function () {
                var currentColIndex = $(this).data('day-index');
                var currentRowIndex = $(this).closest('tr').index();
                var isInSelectedColumn = selectedCells.some(c => c.data('day-index') === currentColIndex);

                if (!isInSelectedColumn) {
                    $(this).addClass('disabled-cell');
                } else {
                    var cellDateTime = getStartOfWeek(moment().add(weekOffset, 'weeks'))
                        .add(currentColIndex, 'days')
                        .hour(parseInt($(this).data('time')));

                    if (currentRowIndex >= minRowIndex - 1 && currentRowIndex <= maxRowIndex + 1) {
                        if (!$(this).hasClass('disabled-past') && cellDateTime.isSameOrAfter(moment())) {
                            $(this).removeClass('disabled-cell');
                        }
                    } else {
                        $(this).addClass('disabled-cell');
                    }
                }
            });
        } else {
            $('#weekTable td').removeClass('disabled-cell');
            $('#selectedDate').val('');
            $('#selectedTime').val('');
        }

        // Обновляем итоговую информацию и пересчитываем стоимость
        updateSelectedInfo();
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

        var selectedPriceId = $('#peopleCount').val();
        var selectedPriceRange = hallPrices.find(function (price) {
            return price.id == selectedPriceId;
        });
        var eveningTime = moment(hall.time_evening, 'HH:mm');

        if (!selectedPriceRange) {
            console.error('No price range found for this selection.');
            return;
        }

        var peopleCount = parseInt($('#peopleCount').val());

        // Генерация временных строк с учетом шага
        for (var time = startTime.clone(); time.isBefore(endTime); time.add(stepMinutes, 'minutes')) {
            var timeLabel = time.format('HH:mm');
            var row = $('<tr></tr>');
            row.append('<th scope="row" class="sticky-col">' + timeLabel + '</th>');

            for (var i = 0; i < 7; i++) {
                var cell = $('<td data-day-index="' + i + '" data-time="' + timeLabel + '"></td>');
                var cellDateTime = startOfWeek.clone().add(i, 'days').hour(time.hour()).minute(time.minute());

                // Проверка на забронированность
                var isBooked = bookings.some(function (booking) {
                    var start = moment(booking.booking_start);
                    var end = moment(booking.booking_end);

                    if (!booking.is_available) {
                        return cellDateTime.isBetween(start, end, null, '[]');
                    }

                    if (booking.payment_id === null) {
                        return cellDateTime.isBetween(start, end, null, '[)');
                    }

                    // Если текущее время является концом брони, не закрашиваем ячейку
                    if (cellDateTime.isSame(end)) {
                        return false;
                    }

                    return cellDateTime.isBetween(start, end, null, '[)');
                });

                // Логика для заблокированных ячеек
                if (isBooked) {

                    var reservedBooking = bookings.find(function (booking) {
                        var start = moment(booking.booking_start);
                        var end = moment(booking.booking_end);
                        return booking.status_payment === 'NEW' && cellDateTime.isBetween(start, end, null, '[]');
                    })

                    if (reservedBooking) {
                        cell.text('Зарезервировано').css({
                            'font-size': '14px', 'user-select': 'none',
                        });
                        cell.addClass('booked-cell');
                    } else {
                        cell.text('Забронировано').css({
                            'font-size': '14px', 'user-select': 'none',
                        });
                        cell.addClass('booked-cell');
                    }
                } else if (cellDateTime.isBefore(now)) {
                    cell.addClass('disabled-past');
                } else {
                    // Если ячейка не заблокирована, добавляем цену
                    var isWeekend = (i === 5 || i === 6); // Суббота и Воскресенье
                    var isEvening = time.isSameOrAfter(eveningTime);
                    var basePrice;

                    // Определяем фиксированную цену на основе дня недели и времени дня
                    if (isWeekend && isEvening) {
                        basePrice = selectedPriceRange.weekend_evening_price;
                    } else if (isWeekend) {
                        basePrice = selectedPriceRange.weekend_price;
                    } else if (isEvening) {
                        basePrice = selectedPriceRange.weekday_evening_price;
                    } else {
                        basePrice = selectedPriceRange.weekday_price;
                    }

                    cell.append('<div class="price">' + basePrice + ' ₽</div>');
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
        var twoWeeksLater = moment().add(2, 'weeks').endOf('isoWeek');

        // Ограничение: если начало недели больше, чем две недели от текущей даты, не переключаемся
        if (startOfWeek.isAfter(twoWeeksLater)) {
            showAlert('Нельзя выбрать дату более чем на две недели вперёд!', 'warning')
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
            var maxTime = times.length > 1 ? times[times.length - 1] : minTime;

            // Преобразуем maxTime в момент, если оно существует
            var maxTimeMoment = moment(maxTime, 'HH:mm');

            // Рассчитываем дополнительное время в зависимости от шага бронирования
            var additionalMinutes = stepbooking * 60; // умножаем шаг на 60, чтобы получить минуты

            // Если выбрана только одна ячейка, добавляем шаг к minTime (и maxTime)
            maxTimeMoment.add(additionalMinutes, 'minutes');

            // Обновляем maxTime для отображения
            maxTime = maxTimeMoment.format('HH:mm');

            var selectedDay = startOfWeek.clone().add(dayIndex, 'days');
            var selectedDate = selectedDay.format('DD.MM.YYYY');
            var dayOfWeek = moment(selectedDate, 'DD.MM.YYYY').format('dddd');

            return {
                date: selectedDate, time: minTime + (maxTime ? ' - ' + maxTime : ''), cells: cells
            };
        });

        var dateTimeText = selectedInfo.map(info => `Дата: ${info.date}, Время: ${info.time} (${moment(info.date, 'DD.MM.YYYY').format('dddd')})`).join('<br>');
        $('#selectedDateTime').html(dateTimeText);

        if (selectedInfo.length > 0) {
            $('#selectedDate').val(selectedInfo[0].date);
            $('#selectedTime').val(selectedInfo.map(info => info.time).join(', '));
        }

        // Подсчет стоимости
        var totalCost = selectedCells.reduce((total, cell) => {
            var price = parseFloat(cell.find('.price').text().replace('₽', ''));
            return total + price;
        }, 0);

        $('#totalCost').text(totalCost);
        $('#totalPrice').val(totalCost);  // Устанавливаем значение скрытого поля
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
        if (cell.hasClass('disabled-past')) {
            return;
        }
        if (cell.hasClass('booked-cell')) {
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

            if (selectedCells.length > 0) {
                var selectedRows = selectedCells.map(c => c.closest('tr').index());
                var minRowIndex = Math.min(...selectedRows);
                var maxRowIndex = Math.max(...selectedRows);

                $('#weekTable td').each(function () {
                    var currentColIndex = $(this).data('day-index');
                    var currentRowIndex = $(this).closest('tr').index();
                    var isInSelectedColumn = selectedCells.some(c => c.data('day-index') === currentColIndex);

                    if (!isInSelectedColumn) {
                        $(this).addClass('disabled-cell');
                    } else {
                        var cellDateTime = getStartOfWeek(moment().add(weekOffset, 'weeks'))
                            .add(currentColIndex, 'days')
                            .hour(parseInt($(this).data('time')));

                        if (currentRowIndex >= minRowIndex - 1 && currentRowIndex <= maxRowIndex + 1) {
                            if (!$(this).hasClass('disabled-past') && cellDateTime.isSameOrAfter(moment())) {
                                $(this).removeClass('disabled-cell');
                            }
                        } else {
                            $(this).addClass('disabled-cell');
                        }
                    }
                });
            } else {
                $('#weekTable td').removeClass('disabled-cell');
                $('#selectedDate').val('');
                $('#selectedTime').val('');
            }

            updateSelectedInfo();
        } else {
            console.warn("Cell data is missing 'dayIndex' or 'time'.");
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
        var twoWeeksLater = moment().add(2, 'weeks').endOf('isoWeek');

        // Ограничение: если начало недели больше, чем две недели от текущей даты, не переключаемся
        if (startOfWeek.isAfter(twoWeeksLater)) {
            showAlert('Нельзя выбрать дату более чем на две недели вперёд', 'warning')
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
        if (!offerAccess) {
            event.preventDefault();
        }

        if (offerAccess && !$('#offerConditions').prop('checked')) {
            showAlert('Пожалуйста, согласитесь с условиями оферты.', 'danger');
            return;
        }

        if (selectedCells.length === 0) {
            return;
        }

        $('#bookingForm').submit();
    });

    loadWeek(weekOffset);

});



