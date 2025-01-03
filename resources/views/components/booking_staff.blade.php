@props(['hall', 'bookings', 'hall_price'])
<style>
    .table td, .table th {
        padding: .50rem;
        vertical-align: top;
        border: 2px solid #d0d2d8;
    }

    .table thead th {
        vertical-align: top;
        border-bottom: none;
    }

    .ui-autocomplete {
        max-height: 100px;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 1050; /* Выше чем у модальных окон */
        position: absolute;
    }

</style>

<div class="modal fade" id="booking" tabindex="-1" role="dialog" aria-labelledby="ModalBooking"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="padding-right: 0">
        <div class="modal-content" style="padding: 5px">
            <div class="modal-header" style="border-bottom: none; padding-bottom: 0">
                <h4 class="modal-title" id="ModalBooking"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 0">

                <div id="loadingOverlay"
                     style="display: none">
                    <!-- Иконка загрузки -->
                    <div class="spinner"></div>
                </div>

                <div class="table-responsive">
                    <div class="sticky-col d-flex justify-content-between">
                        <div style="padding: 15px 0 15px 5px">
                            <button class="btn btn-book" id="prevWeek">&lt;</button>
                            <button class="btn btn-book" id="currentWeek">Сегодня</button>
                            <button class="btn btn-book" id="nextWeek">&gt;</button>
                        </div>
                        <div style="padding: 15px 5px 15px 5px">
                            <button class="btn btn-unblock" id="unlockBooking">Режим брони</button>
                        </div>
                    </div>


                    <table class="table" id="weekTable">
                        <thead>
                        <tr>
                            <th style="width: 15%" scope="col" class="sticky-col" id="monthDisplay"><span
                                    id="currentMonth"></span>
                                <br><span id="weekRange"></span>
                            </th>
                            <th scope="col" class="day"></th>
                            <th scope="col" class="day"></th>
                            <th scope="col" class="day"></th>
                            <th scope="col" class="day"></th>
                            <th scope="col" class="day"></th>
                            <th scope="col" class="day"></th>
                            <th scope="col" class="day"></th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--ячейки генерируются скриптом--}}
                        </tbody>
                    </table>
                    <div class="sticky-col booking-form mt-3">
                        <div id="selectedDateTime">Дата и время: выберите ячейки</div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-md-6 col-sm-12 mb-3">
                            <select id="peopleCount" class="form-control"
                                    style="box-shadow: none; border: 1px solid #dee2e6">

                            </select>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <h5 style="text-align: center">Стоимость: <span id="totalCost">0</span>₽</h5>
                        </div>

                        <div class="col-md-6 col-sm-12 text-right ">
                            <form method="post" id="bookingForm">
                                @csrf
                                <input type="hidden" id="hallIdForm" name="selectedHall">
                                <input type="hidden" name="selectedDate" id="selectedDate">
                                <input type="hidden" name="selectedTime" id="selectedTime">
                                <input type="hidden" name="totalPrice" id="totalPrice">
                                <input type="hidden" name="idPriceHall" id="idPriceHall">
                                <input type="text" name="userNameBooking" class="form-control mb-3"
                                       placeholder="Имя" id="userNameBooking">
                                <input type="text" name="userEmailBooking" class="form-control mb-3"
                                       placeholder="Почта" id="userEmailBooking">
                                <input type="text" name="userPhoneBooking" class="form-control mb-3"
                                       placeholder="+7(___)-___-____" id="userPhoneBooking">
                                <div class="form-check mb-3" style="float: left">
                                    <input type="checkbox" class="form-check-input" id="closeForBooking"
                                           name="closeForBooking">
                                    <label class="form-check-label no-select" for="closeForBooking">Отметить как
                                        недоступный для бронирования</label>
                                </div>
                                <div class="form-group mb-3 d-none" id="reasonInputContainer">
                                    <input type="text" class="form-control" id="reasonInput" name="reasonInput"
                                           placeholder="Введите причину закрытия">
                                </div>
                                <button type="submit" id="saveChanges" class="theme-btn btn-style-one btn-block">
                                    <span class="btn-title">Забронировать</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Подтверждение удаления</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Вы уверены, что хотите удалить это бронирование?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    Подтвердить удаление
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $("#userPhoneBooking").click(function () {
        $(this).setCursorPosition(3);
    }).mask("+7(999)-999-9999");
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ru.min.js"></script>

<script src="/js/bookingStaff.js"></script>

