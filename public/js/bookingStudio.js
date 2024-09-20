$(document).ready(function () {
    var selectedCellsByWeek = {}; // Хранение выделенных ячеек по неделям

    function saveSelectedCellsForWeek() {
        var startOfWeek = getStartOfWeek(moment().add(weekOffset, 'weeks')).format('YYYY-MM-DD');

        if (!selectedCellsByWeek[startOfWeek]) {
            selectedCellsByWeek[startOfWeek] = {cells: [], formData: {}};
        }

        selectedCells.forEach(function (cell) {
            var cellData = {
                date: cell.data('date'), time: cell.data('time')
            };

            var existingCell = selectedCellsByWeek[startOfWeek].cells.find(function (savedCell) {
                return savedCell.date === cellData.date && savedCell.time === cellData.time;
            });

            if (!existingCell) {
                selectedCellsByWeek[startOfWeek].cells.push(cellData);
            }
        });

        selectedCellsByWeek[startOfWeek].formData = {
            selectedDate: $('#selectedDate').val(),
            selectedTime: $('#selectedTime').val(),
            totalPrice: $('#totalPrice').val()
        };
    }


    function restoreSelectedCellsForWeek() {
        var startOfWeek = getStartOfWeek(moment().add(weekOffset, 'weeks')).format('YYYY-MM-DD');
        var weekData = selectedCellsByWeek[startOfWeek];

        if (weekData) {
            weekData.cells.forEach(function (cellData) {
                var cell = $('#weekTable').find(`td[data-date="${cellData.date}"][data-time="${cellData.time}"]`);
                if (cell.length && !cell.hasClass('highlight-cell')) {
                    cell.addClass('highlight-cell');
                    selectedCells.push(cell);
                }
            });

            $('#selectedDate').val(weekData.formData.selectedDate);
            $('#selectedTime').val(weekData.formData.selectedTime);
            $('#totalPrice').val(weekData.formData.totalPrice);
            $('#totalCost').text(weekData.formData.totalPrice);
        }
    }


    function updateFormWithSelectedCells() {
        var allSelectedInfo = [];
        var totalCost = 0;  // Переменная для общей стоимости

        // Проходим по всем неделям и собираем данные
        Object.keys(selectedCellsByWeek).forEach(function (weekKey) {
            var weekData = selectedCellsByWeek[weekKey];

            // Сохраняем ячейки для этой недели
            weekData.cells.forEach(function (cellData) {
                var selectedDate = moment(cellData.date).format('DD.MM.YYYY');

                // Проверяем, есть ли уже данные для этой даты
                var existingInfo = allSelectedInfo.find(function (info) {
                    return info.date === selectedDate;
                });

                if (existingInfo) {
                    // Если для этой даты уже есть данные, объединяем время
                    existingInfo.times.push(cellData.time);
                } else {
                    allSelectedInfo.push({
                        date: selectedDate, times: [cellData.time]
                    });
                }
            });

            // Суммируем стоимость для всех ячеек за эту неделю
            totalCost += parseFloat(weekData.formData.totalPrice || 0);
        });

        // Обновляем поля формы с датами и временем
        if (allSelectedInfo.length > 0) {
            // Для поля selectedDate сохраняем все даты через запятую
            var allDates = allSelectedInfo.map(function (info) {
                return info.date;
            }).join(', ');

            $('#selectedDate').val(allDates);

            // Для поля selectedTime сохраняем диапазоны времени для каждой даты без даты
            var allTimes = allSelectedInfo.map(function (info) {
                var times = info.times.sort((a, b) => moment(a, 'HH:mm') - moment(b, 'HH:mm'));
                return `${times[0]} - ${times[times.length - 1]}`;
            }).join(', ');

            $('#selectedTime').val(allTimes);
        }

        // Обновляем общую стоимость
        $('#totalCost').text(totalCost);
        $('#totalPrice').val(totalCost);
    }


    var initialIdPrice = $('#peopleCount').find('option:selected').val();
    $('#idPriceHall').val(initialIdPrice);

    generateTimeRows();

    $('#peopleCount').change(function () {
        clearBookingForm();
        selectedCells = [];

        var selectedId = $(this).find('option:selected').val();
        $('#idPriceHall').val(selectedId);

        var minPeople = $(this).find('option:selected').data('min_people');
        var maxPeople = $(this).find('option:selected').data('max_people');

        var selectedPriceRange = hallPrices.find(function (price) {
            return minPeople >= price.min_people && maxPeople <= price.max_people;
        });

        if (selectedPriceRange) {
            // Обновляем цены для данного количества людей
            hall.price_weekday = selectedPriceRange.weekday_price;
            hall.price_evening = selectedPriceRange.weekday_evening_price;
            hall.price_weekend = selectedPriceRange.weekend_price;
            hall.price_weekend_evening = selectedPriceRange.weekend_evening_price;
            // Перегенерируем строки с новыми ценами
            generateTimeRows();
        } else {
            console.error('No price range found for this people count.');
        }

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

        var selectedPriceId = $('#peopleCount').val();
        var selectedPriceRange = hallPrices.find(function (price) {
            return price.id == selectedPriceId;
        });
        var eveningTime = moment('18:00', 'HH:mm');

        if (!selectedPriceRange) {
            console.error('No price range found for this selection.');
            return;
        }

        // Генерация временных строк с учетом шага
        for (var time = startTime.clone(); time.isBefore(endTime); time.add(stepMinutes, 'minutes')) {
            var timeLabel = time.format('HH:mm');
            var row = $('<tr></tr>');
            row.append('<th scope="row" class="sticky-col">' + timeLabel + '</th>');

            for (var i = 0; i < 7; i++) {
                var cell = $('<td data-day-index="' + i + '" data-time="' + timeLabel + '"></td>');
                var cellDate = startOfWeek.clone().add(i, 'days').format('YYYY-MM-DD');
                var cellDateTime = startOfWeek.clone().add(i, 'days').hour(time.hour()).minute(time.minute());

                cell.attr('data-date', cellDate);

                // Проверка на забронированность
                var isBooked = bookings.some(function (booking) {
                    var start = moment(booking.booking_start);
                    var end = moment(booking.booking_end);

                    // Если текущее время является концом брони, не закрашиваем ячейку
                    if (cellDateTime.isSame(end)) {
                        return false;
                    }

                    return cellDateTime.isBetween(start, end, null, '[)');
                });

                // Логика для заблокированных ячеек
                if (isBooked) {
                    cell.addClass('booked-cell');
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

        if (startOfWeek.isAfter(twoWeeksLater)) {
            alert('Нельзя выбрать дату более чем на две недели вперёд.');
            return;
        }

        updateWeekDisplay(startOfWeek);
        generateTimeRows();

        restoreSelectedCellsForWeek(); // Восстанавливаем выбранные ячейки после генерации строк
    }


    function updateSelectedInfo() {
        var groupedByDate = selectedCells.reduce(function (acc, cell) {
            var date = cell.data('date');
            var time = cell.data('time');

            if (!acc[date]) {
                acc[date] = [];
            }

            acc[date].push(time);
            return acc;
        }, {});

        var selectedInfo = Object.keys(groupedByDate).map(function (date) {
            var times = groupedByDate[date];
            times.sort(function (a, b) {
                return moment(a, 'HH:mm') - moment(b, 'HH:mm');
            });

            var minTime = times[0];
            var maxTime = times.length > 1 ? times[times.length - 1] : minTime;

            return {
                date: date, time: minTime + (maxTime ? ' - ' + maxTime : '')
            };
        });

        var dateTimeText = selectedInfo.map(function (info) {
            return `Дата: ${moment(info.date).format('DD.MM.YYYY')}, Время: ${info.time}`;
        }).join('<br>');

        $('#selectedDateTime').html(dateTimeText);

        if (selectedInfo.length > 0) {
            $('#selectedDate').val(selectedInfo[0].date);
            $('#selectedTime').val(selectedInfo.map(info => info.time).join(', '));
        }

        var totalCost = selectedCells.reduce(function (total, cell) {
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
        if (cell.hasClass('disabled-past')) {
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

            if (selectedCells.length === 0) {
                $('#selectedDate').val('');
                $('#selectedTime').val('');
            } else {
                $('#weekTable td').removeClass('disabled-cell');
            }


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
        // Очищаем форму только если нет данных для всех недель
        if (Object.keys(selectedCellsByWeek).length === 0) {
            $('#totalCost').text('0');
            $('#totalPrice').val('');
            $('#selectedDate').val('');
            $('#selectedTime').val('');
            $('#selectedDateTime').text('Дата и время: выберите ячейки');
        }
    }


    $('#prevWeek, #nextWeek, #currentWeek').click(function () {
        saveSelectedCellsForWeek();  // Сохраняем выбранные ячейки для текущей недели

        if ($(this).attr('id') === 'prevWeek') {
            weekOffset--;
        } else if ($(this).attr('id') === 'nextWeek') {
            weekOffset++;
        } else {
            weekOffset = 0;  // Текущая неделя
        }

        loadWeek(weekOffset);  // Загружаем новую неделю
        restoreSelectedCellsForWeek();  // Восстанавливаем выбранные ячейки для новой недели
    });


    $('#saveChanges').click(function () {
        saveSelectedCellsForWeek();  // Сохраняем выбранные ячейки для текущей недели перед отправкой

        // Собираем все данные из всех недель
        updateFormWithSelectedCells();

        if (selectedCells.length === 0) {
            alert('Пожалуйста, выберите дату и время.');
            return;
        }

        $('#bookingForm').submit();  // Отправляем форму
    });


    loadWeek(weekOffset);
});
