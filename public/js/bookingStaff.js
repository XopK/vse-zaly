$(document).ready(function () {
    moment.locale('ru');
    var weekOffset = 0;

    var bookings = [];
    var hallPrices = [];
    var hall = {};

    $('.openModalButton').on('click', function () {
        var hallId = $(this).data('id')
        var hallName = $(this).data('name');
        var hallArea = $(this).data('area');

        $('#ModalBooking').text(hallName + ' (Площадь ' + hallArea + ' м²)');

        $.ajax({
            url: '/bookings_get/' + hallId, method: 'GET', success: function (data) {

                bookings = data.bookings;
                hallPrices = data.hall_price;
                hall = data.hall;

                generateTimeRows()

            }, error: function () {
                console.log('Ошибка')
            }
        })

        $('#booking').modal('show');
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
            console.error('No price range found for this selection.');
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
                            cell.text('Закрыто');

                            return true;
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


    }


    $('#prevWeek, #nextWeek, #currentWeek').click(function () {


        if ($(this).attr('id') === 'prevWeek') {
            weekOffset--;
        } else if ($(this).attr('id') === 'nextWeek') {
            weekOffset++;
        } else {
            weekOffset = 0;  // Текущая неделя
        }

        loadWeek(weekOffset);  // Загружаем новую неделю
    });


    loadWeek(weekOffset);
});

$(document).tooltip({
    content: function () {
        return $(this).attr('title');
    }, tooltipClass: 'custom-tooltip',
});



