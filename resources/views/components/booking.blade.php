@props(['hall'])
<style>
    .table td, .table th {
        padding: .50rem;
        vertical-align: top;
        border: 1px solid #d0d2d8;
    }

    .table thead th {
        vertical-align: top;
        border-bottom: none;
    }

</style>
<div class="modal fade" id="booking" tabindex="-1" role="dialog" aria-labelledby="ModalBooking"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="padding-right: 0">
        <div class="modal-content" style="padding: 5px">
            <div class="modal-header" style="border-bottom: none; padding-bottom: 0">
                <h4 class="modal-title" id="ModalBooking">{{$hall->name_hall}} (Площадь {{$hall->area_hall}} м²)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 0">
                <div class="table-responsive">
                    <div class="sticky-col" style="padding: 15px 0 15px 5px">
                        <button class="btn btn-book" id="prevWeek">&lt;</button>
                        <button class="btn btn-book" id="currentWeek">Сегодня</button>
                        <button class="btn btn-book" id="nextWeek">&gt;</button>
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
                    <div class="booking-form mt-3">
                        <div id="selectedDateTime">Дата и время: выберите ячейки</div>
                    </div>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Стоимость: 5000</h5>
                <div class="modal-buttons">
                    <form action="/booking" method="post" id="bookingForm">
                        @csrf
                        <input type="hidden" name="selectedHall" value="{{$hall->id}}">
                        <input type="hidden" name="selectedDate" id="selectedDate">
                        <input type="hidden" name="selectedTime" id="selectedTime">

                        <button type="submit" id="saveChanges" class="theme-btn btn-style-one btn-block"><span
                                class="btn-title">Забронировать</span></button>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ru.min.js"></script>
<script src="/js/booking.js"></script>

