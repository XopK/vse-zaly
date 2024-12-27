$(document).ready(function () {
    var weekOffset = 0;
    var bookings = [];
    var hallPrices = [];
    var hall = {};

    var selectedCellsByWeek = {};
    var bookedCellsByWeek = {};
    var selectedCells = [];
    var isUnlockMode = false;

    $('#closeForBooking').on('change', function () {
        if ($(this).is(':checked')) {
            $('#reasonInputContainer').hide().removeClass('d-none').fadeIn(300); // Плавное появление
        } else {
            $('#reasonInputContainer').fadeOut(300, function () {
                $(this).addClass('d-none'); // Плавное исчезновение
            });
        }
    });

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

    $('.openModalButton').on('click', function () {
        var hallId = $(this).data('id')
        var hallName = $(this).data('name');
        var hallArea = $(this).data('area');

        selectedCellsByWeek = {};
        bookedCellsByWeek = {};
        selectedCells = [];

        weekOffset = 0;
        loadWeek(weekOffset);

        $.ajax({
            url: '/bookings_get/' + hallId, method: 'GET', beforeSend: function () {
                // Скрываем таблицу с анимацией перед обновлением
                $('.table-responsive').fadeOut(200); // ID контейнера с таблицей
            }, success: function (data) {
                bookings = data.bookings;
                hallPrices = data.hall_price;
                hall = data.hall;

                $('#ModalBooking').text(hallName + ' (Площадь ' + hallArea + ' м²)');
                $('#hallIdForm').val(hallId);

                generatePrices(hallPrices);

                var initialIdPrice = $('#peopleCount').find('option:selected').val();
                $('#idPriceHall').val(initialIdPrice);

                updateSelectedInfo();

                generateTimeRows();

                // Показываем таблицу с новой информацией
                $('.table-responsive').fadeIn(200); // ID контейнера с таблицей
            }, error: function () {
                console.log('Ошибка');
                // В случае ошибки возвращаем таблицу
                $('.table-responsive').fadeIn(200);
            }
        });


        $('#booking').modal('show');
    });

    function generatePrices(hallPrices) {
        var select = $('#peopleCount');
        select.empty(); // Очистка <select>

        hallPrices.forEach(function (price, index) {
            var option = $('<option></option>')
                .val(price.id) // Значение option
                .text('от ' + price.min_people + ' до ' + price.max_people + ' человек') // Текст
                .attr('data-min_people', price.min_people) // Атрибуты data-*
                .attr('data-max_people', price.max_people)
                .attr('data-min_price', price.min_price)
                .attr('data-max_price', price.max_price);

            select.append(option); // Добавление опции в <select>
        });

        select.find('option').eq(0).attr('selected', '');
    }


    $('#unlockBooking').click(function () {
        isUnlockMode = !isUnlockMode; // Переключение значения
        $(this).toggleClass('active'); // Добавляем или убираем класс 'active'

        if (isUnlockMode) {
            $(this).text('Режим отмены');
        } else {
            $(this).text('Режим брони');
        }
    });

    $('#closeForBooking').on('change', function () {
        updateSelectedInfo();  // Вызовем функцию для обновления данных
    });

    $('#weekTable').on('click', 'td.booked-cell', function () {
        if (isUnlockMode) {
            var cell = $(this);
            var bookingId = cell.data('booking-id');
            var start = cell.data('start');
            var end = cell.data('end');
            var date = cell.data('date');
            var formattedDate = moment(date).format('DD.MM.YYYY');

            $('#deleteModal .modal-body').text(`Вы уверены, что хотите удалить бронирование ${formattedDate} ${start} - ${end}`);
            $('#deleteModal').modal('show');

            $('#booking .modal-content').addClass('modal-darken');

            $('#confirmDelete').off('click').on('click', function () {
                var button = $(this);
                var spinner = button.find('.spinner-border');

                spinner.removeClass('d-none');
                button.prop('disabled', true);

                $.ajax({
                    url: '/delete_booking_partner/' + bookingId, method: 'DELETE', data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    }, success: function (response) {
                        showAlert('Бронь отменена!', 'success');

                        bookings = bookings.filter(function (booking) {
                            return booking.id !== bookingId;
                        });

                        generateTimeRows();

                        $('#deleteModal').modal('hide');
                        spinner.addClass('d-none');
                        button.prop('disabled', false);
                    }, error: function (xhr, status, error) {
                        showAlert('Ошибка отмены!', 'danger');

                        spinner.addClass('d-none');
                        button.prop('disabled', false);
                    }
                });
            });
        }
    });

    $('#deleteModal').on('hidden.bs.modal', function () {
        $('#booking .modal-content').removeClass('modal-darken');
        $('body').css('overflow', 'hidden');
        $('#booking').css('overflow', 'auto');
    });

    $('#weekTable').on('click', 'td.closed-cell', function () {
        if (isUnlockMode) {
            var cell = $(this);
            cell.removeClass('closed-cell');
            cell.empty();

            // Добавляем цену в ячейку после разблокировки
            var date = cell.data('date');
            var time = cell.data('time');

            selectedCellsData.push({date: date, time: time});
            clearTimeout(selectionTimeout);

            selectionTimeout = setTimeout(function () {
                $.ajax({
                    url: '/booking/unlock', // Укажите URL для обработки на сервере
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({cells: selectedCellsData, hall_id: hall.id}),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        selectedCellsData = [];

                        bookings = bookings.filter(function (booking) {

                            var start = moment(booking.booking_start);
                            var end = moment(booking.booking_end);
                            var cellDateTime = moment(`${date} ${time}`, 'YYYY-MM-DD HH:mm');
                            return !cellDateTime.isBetween(start, end, null, '[)');
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("Ошибка:", jqXHR.responseJSON.error);
                    }
                });
            }, selectionDelay);


            // Определение цены для текущей ячейки
            var selectedPriceId = $('#peopleCount').val();
            var selectedPriceRange = hallPrices.find(function (price) {
                return price.id == selectedPriceId;
            });

            if (selectedPriceRange) {
                var isWeekend = moment(date).day() === 6 || moment(date).day() === 0;
                var eveningTime = moment(hall.time_evening, 'HH:mm');
                var isEvening = moment(time, 'HH:mm').isSameOrAfter(eveningTime);
                var price;

                if (isWeekend && isEvening) {
                    price = selectedPriceRange.weekend_evening_price;
                } else if (isWeekend) {
                    price = selectedPriceRange.weekend_price;
                } else if (isEvening) {
                    price = selectedPriceRange.weekday_evening_price;
                } else {
                    price = selectedPriceRange.weekday_price;
                }

                cell.append('<div class="price">' + price + ' ₽</div>'); // Добавляем цену
            } else {
                console.error("Selected price range not found.");
            }

            return;
        }
    });

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

                // Обновляем цену ячеек после смены количества человек
                var newPrice = cell.find('.price').text().replace('₽', '').trim();
                cellData.price = parseFloat(newPrice); // Обновляем цену для ячейки
            });

            $('#selectedDate').val(weekData.formData.selectedDate);
            $('#selectedTime').val(weekData.formData.selectedTime);
            $('#totalPrice').val(weekData.formData.totalPrice);
            $('#totalCost').text(weekData.formData.totalPrice);
        }

        // Добавляем обновление общей стоимости
        updateSelectedInfo();
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


        // Перегенерируем строки времени для отображения новых цен
        generateTimeRows();

        // Восстанавливаем выделенные ячейки и обновляем их цены
        restoreSelectedCellsForWeek();

        // Обновляем информацию о выделенных ячейках и пересчитываем итоговую стоимость
        updateSelectedInfo();
    });

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

        var stepMinutes = hall.step_booking * 60;  // Переводим шаг из часов в минуты
        var startTime = moment(hall.start_time, 'HH:mm');
        var endTime = moment(hall.end_time, 'HH:mm');

        var selectedPriceId = $('#peopleCount').val();
        var selectedPriceRange = hallPrices.find(function (price) {
            return price.id == selectedPriceId;
        });
        var eveningTime = moment(hall.time_evening, 'HH:mm');

        if (!selectedPriceRange) {
            return;
        }

        for (var time = startTime.clone(); time.isBefore(endTime); time.add(stepMinutes, 'minutes')) {
            var timeLabel = time.format('HH:mm');
            var row = $('<tr></tr>');
            row.append('<th scope="row" class="sticky-col">' + timeLabel + '</th>');

            for (var i = 0; i < 7; i++) {
                var cell = $('<td data-day-index="' + i + '" data-time="' + timeLabel + '"></td>');
                var cellDate = startOfWeek.clone().add(i, 'days').format('YYYY-MM-DD');
                var cellDateTime = startOfWeek.clone().add(i, 'days').hour(time.hour()).minute(time.minute());

                cell.attr('data-date', cellDate);

                var isBooked = bookings.some(function (booking) {
                    var start = moment(booking.booking_start);
                    var end = moment(booking.booking_end);

                    if (booking.is_available == 0) {
                        var isCellBooked = cellDateTime.isBetween(start, end, null, '[]');
                        if (isCellBooked) {
                            cell.addClass('closed-cell');
                            cell.text('Закрыто'); // Текст "Закрыто" для заблокированных ячеек

                            return true; // Прерываем дальнейшую проверку для заблокированного интервала
                        }
                    }

                    var isCellBooked = cellDateTime.isBetween(start, end, null, '[)');
                    if (isCellBooked) {

                        var peopleCount = booking.min_people;  // В данном случае мы работаем с min_people, но можно использовать любое поле
                        var bookingPriceRange = hallPrices.find(function (priceRange) {
                            return peopleCount >= priceRange.min_people && peopleCount <= priceRange.max_people;
                        });

                        if (bookingPriceRange && bookingPriceRange.color) {
                            cell.css('background-color', bookingPriceRange.color);
                        }

                        var bookingStart = moment(booking.booking_start);
                        var bookingEnd = moment(booking.booking_end);

                        var formattedStart = bookingStart.format('HH:mm');
                        var formattedEnd = bookingEnd.format('HH:mm');

                        cell.addClass('booked-cell');
                        cell.attr('data-booking-id', booking.id);
                        cell.attr('data-start', formattedStart);
                        cell.attr('data-end', formattedEnd);

                        if (booking.user) {
                            // Для зарегистрированных пользователей
                            cell.text(booking.user.name);
                            cell.attr('title', `${booking.user.name} ${booking.user.phone}<br>(${booking.total_price}₽ ${formattedStart}-${formattedEnd})`);
                            cell.attr('data-user-url', booking.user.url);
                        } else if (booking.unregister_user) {
                            // Для незарегистрированных пользователей
                            cell.text(booking.unregister_user.name);
                            cell.attr('title', `${booking.unregister_user.name} ${booking.unregister_user.phone}<br>(${booking.total_price}₽ ${formattedStart}-${formattedEnd})`); // Всплывающая подсказка
                            cell.removeAttr('data-user-url'); // Не устанавливаем URL для незарегистрированных пользователей
                            cell.attr('data-warning', 'Этот пользователь не зарегистрирован на сайте.');
                        }

                    }
                    return isCellBooked;
                });

                if (!isBooked) {
                    if (cellDateTime.isBefore(now)) {
                        cell.addClass('disabled-past');
                    } else {
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
        var twoWeeksLater = moment().add(6, 'weeks').endOf('isoWeek');

        if (startOfWeek.isAfter(twoWeeksLater)) {
            showAlert('danger', 'Нельзя выбрать дату более чем на шесть недель вперёд!');
            return;
        }

        updateWeekDisplay(startOfWeek);
        generateTimeRows();

        restoreSelectedCellsForWeek();
    }


    function updateSelectedInfo() {
        var allSelectedInfo = [];
        var totalCost = 0;  // Переменная для общей стоимости
        var bookingStep = hall.step_booking * 60; // Шаг бронирования в минутах, например 30 минут
        var isHallClosed = $('#closeForBooking').prop('checked');

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

                // Суммируем стоимость для всех ячеек за эту неделю
                totalCost += parseFloat(cellData.price || 0); // Используем сохраненную цену
            });
        });

        // Обновляем div с выбранными датами и временем
        if (allSelectedInfo.length > 0) {
            var allDates = allSelectedInfo.map(function (info) {
                return info.date;
            }).join(', ');

            var allTimes = allSelectedInfo.map(function (info) {
                var times = info.times.sort((a, b) => moment(a, 'HH:mm') - moment(b, 'HH:mm'));

                // Рассчитываем время окончания для каждого выбранного времени с учетом шага бронирования
                var startTime = moment(times[0], 'HH:mm');
                var endTime;
                if (isHallClosed) {
                    // Если зал закрыт, не прибавляем шаг бронирования
                    endTime = moment(times[times.length - 1], 'HH:mm'); // Без добавления шага бронирования
                } else {
                    // Если зал открыт для бронирования, добавляем шаг бронирования
                    endTime = moment(times[times.length - 1], 'HH:mm').add(bookingStep, 'minutes'); // Добавляем шаг бронирования
                }

                return `${startTime.format('HH:mm')} - ${endTime.format('HH:mm')}`;
            }).join(', ');

            // Обновляем поля формы для отправки
            $('#selectedDate').val(allDates);
            $('#selectedTime').val(allTimes);

            // Обновляем div с информацией для пользователя
            // Обновляем div с информацией для пользователя
            var selectedInfoText = allSelectedInfo.map(function (info) {
                var times = info.times.sort((a, b) => moment(a, 'HH:mm') - moment(b, 'HH:mm'));

                var startTime = moment(times[0], 'HH:mm');
                var endTime;

                if (isHallClosed) {
                    // Если зал закрыт, не прибавляем шаг бронирования
                    endTime = moment(times[times.length - 1], 'HH:mm'); // Без добавления шага бронирования
                } else {
                    // Если зал открыт для бронирования, добавляем шаг бронирования
                    endTime = moment(times[times.length - 1], 'HH:mm').add(bookingStep, 'minutes'); // Добавляем шаг бронирования
                }

                return `${info.date}: ${startTime.format('HH:mm')} - ${endTime.format('HH:mm')}`;
            }).join('<br>'); // Используем <br> для разрыва строки

            $('#selectedDateTime').html('Дата и время:<br>' + selectedInfoText);

        } else {
            $('#selectedDate').val('');
            $('#selectedTime').val('');
            $('#selectedDateTime').html('Дата и время: выберите ячейки');
        }

        // Обновляем общую стоимость в span
        $('#totalCost').text(totalCost);  // Отображаем стоимость с двумя знаками после запятой
        $('#totalPrice').val(totalCost);  // Обновляем скрытое поле с общей стоимостью

        saveSelectedCellsForWeek();
    }

    function highlightCellsInBetween() {
        if (selectedCells.length < 2) return;

        // Группируем выбранные ячейки по дням
        var groupedByDay = {};

        selectedCells.forEach(function (cell) {
            var dayIndex = cell.data('day-index');
            if (!groupedByDay[dayIndex]) {
                groupedByDay[dayIndex] = [];
            }
            groupedByDay[dayIndex].push(cell);
        });

        // Проходим по каждому дню и выделяем ячейки между первой и последней выбранными ячейками в рамках одного дня
        Object.keys(groupedByDay).forEach(function (dayIndex) {
            var cellsInDay = groupedByDay[dayIndex];
            if (cellsInDay.length < 2) return; // Если в этот день выбрано менее 2-х ячеек, пропускаем

            // Сортируем ячейки по времени (ряду)
            cellsInDay.sort(function (a, b) {
                return a.closest('tr').index() - b.closest('tr').index();
            });

            var firstCell = cellsInDay[0];
            var lastCell = cellsInDay[cellsInDay.length - 1];

            var firstRowIndex = firstCell.closest('tr').index();
            var lastRowIndex = lastCell.closest('tr').index();

            // Проходим по строкам (времени) между первой и последней ячейкой в рамках одного дня
            $('#weekTable tbody tr').each(function (rowIndex, row) {
                if (rowIndex >= firstRowIndex && rowIndex <= lastRowIndex) {
                    var cell = $(row).find(`td[data-day-index="${dayIndex}"]`);
                    if (!cell.hasClass('highlight-cell') && !cell.hasClass('disabled-past') && !cell.hasClass('booked-cell')) {
                        cell.addClass('highlight-cell');
                        selectedCells.push(cell);

                        var price = parseFloat(cell.find('.price').text().replace('₽', '').trim());
                        var date = cell.data('date');
                        var time = cell.data('time');
                        var startOfWeek = getStartOfWeek(moment().add(weekOffset, 'weeks')).format('YYYY-MM-DD');

                        // Добавляем ячейку в объект selectedCellsByWeek
                        if (!selectedCellsByWeek[startOfWeek]) {
                            selectedCellsByWeek[startOfWeek] = {cells: [], formData: {}};
                        }
                        selectedCellsByWeek[startOfWeek].cells.push({date: date, time: time, price: price});
                    }
                }
            });
        });
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

    var selectionTimeout;
    var selectionDelay = 1000;
    var selectedCellsData = [];

    $('#weekTable').on('click', 'td', function () {

        if (isUnlockMode) {
            return;
        }

        var cell = $(this);
        var warning = cell.attr('data-warning');

        if (warning) {
            $('.alert-container').html(`
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>${warning}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `);
        }

        if (cell.hasClass('disabled-past')) {
            return;
        }

        if (cell.hasClass('booked-cell')) {
            var userPageUrl = cell.data('user-url');
            if (userPageUrl) {
                window.location.href = userPageUrl; // Перенаправляем на страницу забронировавшего
            }
            return;
        }

        if (cell.hasClass('closed-cell')) {
            return;
        }

        var dayIndex = cell.data('day-index');
        var time = cell.data('time');
        var date = cell.data('date');

        if (dayIndex !== undefined && time !== undefined) {
            var startOfWeek = getStartOfWeek(moment().add(weekOffset, 'weeks')).format('YYYY-MM-DD');

            // Если ячейка находится между первой и последней выделенной, отменяем выбор
            if (isCellBetweenSelected(cell)) {
                // Убираем подсветку со всех выбранных ячеек
                selectedCells.forEach(function (c) {
                    c.removeClass('highlight-cell');
                });
                selectedCells = [];

                // Очищаем объект selectedCellsByWeek для текущей недели
                delete selectedCellsByWeek[startOfWeek];

                updateSelectedInfo(); // Обновляем информацию на экране
                return; // Прекращаем выполнение, так как выбор отменён
            }

            var price = parseFloat(cell.find('.price').text().replace('₽', '').trim());

            if (cell.hasClass('highlight-cell')) {
                // Если ячейка уже выбрана, убираем подсветку
                cell.removeClass('highlight-cell');
                selectedCells = selectedCells.filter(c => c.get(0) !== cell.get(0));

                // Удаляем ячейку из объекта selectedCellsByWeek
                if (selectedCellsByWeek[startOfWeek] && selectedCellsByWeek[startOfWeek].cells) {
                    selectedCellsByWeek[startOfWeek].cells = selectedCellsByWeek[startOfWeek].cells.filter(function (savedCell) {
                        return !(savedCell.date === date && savedCell.time === time);
                    });

                    // Если все ячейки недели удалены, удаляем и сам объект недели
                    if (selectedCellsByWeek[startOfWeek].cells.length === 0) {
                        delete selectedCellsByWeek[startOfWeek];
                    }
                }
            } else {
                // Добавляем подсветку и сохраняем выбранную ячейку
                cell.addClass('highlight-cell');
                selectedCells.push(cell);

                // Если неделя еще не существует в объекте, создаем её
                if (!selectedCellsByWeek[startOfWeek]) {
                    selectedCellsByWeek[startOfWeek] = {cells: [], formData: {}};
                }

                // Добавляем новую ячейку
                selectedCellsByWeek[startOfWeek].cells.push({
                    date: date, time: time, price: price
                });
            }

            highlightCellsInBetween();

            // Обновляем информацию на экране
            updateSelectedInfo();
        } else {
            console.warn("Cell data is missing 'dayIndex' or 'time'.");
        }
    });

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
        event.preventDefault();

        saveSelectedCellsForWeek();  // Сохраняем выбранные ячейки для текущей недели перед отправкой

        if (selectedCells.length === 0) {
            showAlert('Нет выбранных данных для отправки!', 'warning');
            return;
        }

        var formData = $('#bookingForm').serialize();


        $.ajax({
            url: '/booking/for_partner', // Укажите URL для обработки данных на сервере
            method: 'POST', data: formData, // Отправляем сериализованные данные формы
            cache: false, headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Добавление CSRF-токена для безопасности
            },

            beforeSend: function () {
                $('#loadingOverlay').show();
                $('.modal').animate({scrollTop: 0}, 'slow');
            },

            success: function (response) {

                if (response.booking) {
                    const bookingDetails = response.bookingDetails;
                    const userName = $('#userNameBooking').val();
                    const userPhone = response.phoneUser;
                    const totalPrice = $('#totalPrice').val();
                    const isUnregistered = response.unregister;
                    const urlUser = isUnregistered ? null : response.urlUser;

                    console.log('ответ', bookingDetails);

                    // Обходим массив бронирований из ответа
                    bookingDetails.forEach(function (booking) {
                        const bookingId = booking.id;
                        const bookingStart = moment(booking.booking_start);
                        const bookingEnd = moment(booking.booking_end);

                        const formattedStart = bookingStart.format('HH:mm');
                        const formattedEnd = bookingEnd.format('HH:mm');

                        if (!isUnregistered) {
                            booking.user.url = urlUser;
                        } else {
                            booking.unregister_user = {
                                name: booking.user ? booking.user.name : "Имя не указано",
                                phone: booking.user ? booking.user.phone : "Телефон не указан",
                                email: booking.user ? booking.user.email : "Email не указан",
                            };

                            delete booking.user;
                        }

                        if (booking.is_available === undefined) {
                            booking.is_available = true;
                        }

                        selectedCells.forEach(function (cell) {
                            const cellDate = cell.data('date');
                            const cellTime = cell.data('time');
                            const cellDateTime = moment(`${cellDate} ${cellTime}`, 'YYYY-MM-DD HH:mm');

                            // Проверяем, попадает ли ячейка в диапазон бронирования
                            if (cellDateTime.isBetween(bookingStart, bookingEnd, null, '[)')) {
                                cell.removeClass('highlight-cell');
                                cell.addClass('booked-cell');
                                cell.text(userName);
                                cell.attr('title', `${userName} ${userPhone} (${totalPrice} ₽)`);
                                cell.attr('data-booking-id', bookingId);  // Присваиваем id текущего бронирования

                                cell.attr('data-start', formattedStart);
                                cell.attr('data-end', formattedEnd);

                                if (isUnregistered) {
                                    cell.removeAttr('data-user-url');
                                    cell.attr('data-warning', 'Этот пользователь не зарегистрирован на сайте.');
                                } else {
                                    cell.attr('data-user-url', urlUser);
                                }
                            }
                        });
                        bookings.push(booking);
                    });

                    showAlert('Бронирование успешно добавлено!', 'success');
                }
                if (response.close) {

                    response.bookingsСlose.forEach(function (closedBook) {
                        bookings.push(closedBook);
                    });

                    selectedCells.forEach(function (cell) {
                        cell.removeClass('highlight-cell');
                        cell.addClass('closed-cell');
                        cell.text('Закрыто');
                    });

                    $('#reasonInputContainer').fadeOut(300, function () {
                        $(this).addClass('d-none'); // Плавное исчезновение
                    });

                    showAlert('Ячейка успешно закрыта!', 'warning');
                }

                // Очищаем форму после успешной отправки
                $('#bookingForm').trigger('reset'); // Сбрасываем все поля формы
                $('#selectedDateTime').text('Дата и время: выберите ячейки'); // Сбрасываем текст отображения выбранных дат и времени
                $('#totalCost').text('0'); // Сбрасываем отображаемую общую стоимость
                $('#totalPrice').val(''); // Очищаем скрытое поле с общей стоимостью

                // Сбрасываем внутренние данные о выбранных ячейках
                selectedCells = [];
                selectedCellsByWeek = {};
                generateTimeRows();

            }, error: function (jqXHR, textStatus, errorThrown) {
                console.error('Ошибка при отправке данных:', jqXHR.responseText);
                showAlert('Произошла ошибка при отправке данных.', 'danger');
                $('#loadingOverlay').hide(); // Скрываем оверлей в случае ошибки
            },

            complete: function () {
                $('#loadingOverlay').hide(); // Скрываем оверлей
            }
        });
    });


    loadWeek(weekOffset);
});

$(document).tooltip({
    content: function () {
        return $(this).attr('title');
    }, tooltipClass: 'custom-tooltip',
});



