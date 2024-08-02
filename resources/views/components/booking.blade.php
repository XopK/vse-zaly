@props(['hall'])
<div class="modal fade" id="booking" tabindex="-1" role="dialog" aria-labelledby="ModalBooking"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="padding-right: 0">
        <div class="modal-content" style="padding: 5px">
            <div class="modal-header" style="border-bottom: none">
                <h4 class="modal-title" id="ModalBooking">{{$hall->name_hall}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <div class="month-switcher sticky-col">
                        <button id="prevMonth">&lt;</button>
                        <span id="currentMonth">Январь</span>
                        <button id="nextMonth">&gt;</button>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col" class="sticky-col">Месяц</th>
                            <th scope="col">ПН</th>
                            <th scope="col">ВТ</th>
                            <th scope="col">СР</th>
                            <th scope="col">ЧТ</th>
                            <th scope="col">ПТ</th>
                            <th scope="col">СБ</th>
                            <th scope="col">ВС</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row" class="sticky-col">9:00</th>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                        </tr>
                        <tr>
                            <th scope="row" class="sticky-col">10:00</th>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                        </tr>
                        <tr>
                            <th scope="row" class="sticky-col">11:00</th>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                        </tr>
                        <tr>
                            <th scope="row" class="sticky-col">12:00</th>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                        </tr>
                        <tr>
                            <th scope="row" class="sticky-col">13:00</th>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                        </tr>
                        <tr>
                            <th scope="row" class="sticky-col">14:00</th>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                        </tr>
                        <tr>
                            <th scope="row" class="sticky-col">15:00</th>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                        </tr>
                        <tr>
                            <th scope="row" class="sticky-col">16:00</th>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                        </tr>
                        <tr>
                            <th scope="row" class="sticky-col">17:00</th>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                        </tr>
                        <tr>
                            <th scope="row" class="sticky-col">18:00</th>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                        </tr>
                        <tr>
                            <th scope="row" class="sticky-col">19:00</th>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                        </tr>
                        <tr>
                            <th scope="row" class="sticky-col">20:00</th>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                        </tr>
                        <tr>
                            <th scope="row" class="sticky-col">21:00</th>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                            <td>Цена</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Стоимость: 5000</h5>
                <div class="modal-buttons">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>

            </div>
        </div>
    </div>
</div>

