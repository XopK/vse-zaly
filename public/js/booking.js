$(document).ready(function () {
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

        for (var hour = 9; hour <= 22; hour++) {
            var timeLabel = hour + ':00';
            var row = $('<tr></tr>');
            row.append('<th scope="row" class="sticky-col">' + timeLabel + '</th>');

            for (var i = 0; i < 7; i++) {
                var cell = $('<td data-day-index="' + i + '" data-time="' + timeLabel + '"></td>');
                var cellDateTime = getStartOfWeek(moment().add(weekOffset, 'weeks')).add(i, 'days').hour(hour);

                if (cellDateTime.isBefore(now)) {
                    cell.addClass('disabled-past');
                }

                row.append(cell);
            }

            tbody.append(row);
        }
    }

    function loadWeek(offset) {
        // Сбрасываем выбранные ячейки при загрузке новой недели
        selectedCells = [];
        $('#weekTable td').removeClass('highlight-cell');

        var startOfWeek = getStartOfWeek(moment().add(offset, 'weeks'));
        updateWeekDisplay(startOfWeek);
        generateTimeRows();
    }

    function updateSelectedInfo() {
        if (selectedCells.length === 0) {
            $('#selectedDateTime').text('Дата и время: выберите ячейки');
            return;
        }

        var groupedByDay = selectedCells.reduce((acc, cell) => {
            var dayIndex = cell.data('day-index');
            var time = cell.data('time');
            if (!acc[dayIndex]) {
                acc[dayIndex] = [];
            }
            acc[dayIndex].push(time);
            return acc;
        }, {});

        var startOfWeek = getStartOfWeek(moment().add(weekOffset, 'weeks'));
        var selectedInfo = Object.keys(groupedByDay).map(dayIndex => {
            var times = groupedByDay[dayIndex];
            times.sort((a, b) => moment(a, 'HH:mm') - moment(b, 'HH:mm'));

            var minTime = times[0];
            var maxTime = times.length > 1 ? times[times.length - 1] : null;

            var selectedDay = startOfWeek.clone().add(dayIndex, 'days');
            var selectedDate = selectedDay.format('DD.MM.YYYY');

            return {
                date: selectedDate,
                time: minTime + (maxTime ? ' - ' + maxTime : '')
            };
        });

        var dateTimeText = selectedInfo.map(info => `Дата: ${info.date}, Время: ${info.time}`).join('<br>');
        $('#selectedDateTime').html(dateTimeText);

        if (selectedInfo.length > 0) {
            $('#selectedDate').val(selectedInfo[0].date);
            $('#selectedTime').val(selectedInfo.map(info => info.time).join(', '));
        }
    }

    function isCellBetweenSelected(cell) {
        if (selectedCells.length < 2) return false;

        var colIndex = cell.index();
        var rowIndex = cell.closest('tr').index();

        var selectedRows = selectedCells.filter(c => c.index() === colIndex).map(c => c.closest('tr').index());

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

            if (selectedCells.length > 0) {
                var selectedRows = selectedCells.map(c => c.closest('tr').index());
                var minRowIndex = Math.min(...selectedRows);
                var maxRowIndex = Math.max(...selectedRows);

                $('#weekTable td').each(function () {
                    var currentColIndex = $(this).index();
                    var currentRowIndex = $(this).closest('tr').index();
                    var isInSelectedColumn = selectedCells.some(c => c.index() === currentColIndex);

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
            }

            updateSelectedInfo();
        } else {
            console.warn("Cell data is missing 'dayIndex' or 'time'.");
        }
    });

    $(document).keydown(function (e) {
        if (selectedCells.length > 0) {
            var cell = selectedCells[0];
            var colIndex = cell.index();
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

    $('#saveChanges').click(function () {
        if (selectedCells.length === 0) {
            alert('Пожалуйста, выберите дату и время.');
            return;
        }
        $('#bookingForm').submit();
    });

    loadWeek(weekOffset);
});
