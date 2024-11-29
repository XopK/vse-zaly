<?php

namespace App\Http\Controllers;

use App\Mail\receiptBooking;
use App\Mail\receiptBookingforPartner;
use App\Models\BookingHall;
use App\Models\Hall;
use App\Models\HallPrice;
use App\Models\UnregisteredUser;
use App\Models\User;
use App\Traits\PhoneNormalizerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class BookingController extends Controller
{

    use PhoneNormalizerTrait;

    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function create_booking(Request $request)
    {
        $validated = $request->validate([
            'selectedHall' => 'required',
            'selectedDate' => 'required',
            'selectedTime' => 'required',
            'totalPrice' => 'required',
            'idPriceHall' => 'required',
        ], [
            'selectedDate.required' => 'Выберите дату!',
            'selectedTime.required' => 'Выберите время!',
        ]);


        $user = Auth::user();
        $hallPrice = HallPrice::find($request->idPriceHall);

        try {
            $date = Carbon::createFromFormat('d.m.Y', $request->selectedDate);
        } catch (\Exception $e) {
            return back()->withErrors(['selectedDate' => 'Неверный формат даты']);
        }

        $times = explode(' - ', $request->selectedTime);
        if (count($times) != 2) {
            return back()->withErrors(['selectedTime' => 'Неверный формат времени']);
        }

        try {
            $startDateTime = Carbon::createFromFormat('d.m.Y H:i', $date->format('d.m.Y') . ' ' . $times[0]);
            $endDateTime = Carbon::createFromFormat('d.m.Y H:i', $date->format('d.m.Y') . ' ' . $times[1]);
        } catch (\Exception $e) {
            return back()->withErrors(['startandend' => 'Ошибка в формате времени или даты']);
        }

        $checking = $this->checkUserBooking($request, $startDateTime, $endDateTime);


        if ($checking) {

            $bookingHall = BookingHall::create([
                'id_hall' => $request->selectedHall,
                'id_user' => $user->id,
                'booking_start' => $startDateTime,
                'booking_end' => $endDateTime,
                'total_price' => $request->totalPrice,
                'min_people' => $hallPrice->min_people,
                'max_people' => $hallPrice->max_people,
            ]);

            $paymentUrl = $this->payment_bookings($request, $bookingHall);

            $bookingHall->link_payment = $paymentUrl;
            $bookingHall->save();

            if ($paymentUrl) {
                return redirect()->away($paymentUrl);
            } else {
                return back()->with('error', 'Ошибка бронирования!');
            }

        }

    }

    private function checkUserBooking($request, $startDateTime, $endDateTime)
    {
        $hall = Hall::find($request->selectedHall);
        $hallPrice = HallPrice::find($request->idPriceHall);

        $existingBookingHall = BookingHall::where('id_hall', $request->selectedHall)
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->where(function ($query) use ($startDateTime, $endDateTime) {
                    $query->where('booking_start', '<', $endDateTime)
                        ->where('booking_end', '>', $startDateTime);
                });
            })->first();

        if ($existingBookingHall) {
            return false;
        }

        $totalPrice = 0;
        $stepBooking = $hall->step_booking * 60;

        $timezone = 'Asia/Yekaterinburg';

        $selectedDate = $request->selectedDate;
        $selectedTime = $request->selectedTime;

        list($startTime, $endTime) = explode(' - ', $selectedTime);

        $startDateTime = Carbon::createFromFormat('d.m.Y H:i', "{$selectedDate} {$startTime}", $timezone);
        $endDateTime = Carbon::createFromFormat('d.m.Y H:i', "{$selectedDate} {$endTime}", $timezone);

        if ($endDateTime->lt($startDateTime)) {
            $endDateTime->addDay();
        }

        // Цикл расчета стоимости бронирования
        $currentDateTime = $startDateTime->copy();
        $eveningStartTime = $currentDateTime->copy()->setTimeFromTimeString($hall->time_evening);

        while ($currentDateTime->lt($endDateTime)) {
            $isWeekend = in_array($currentDateTime->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY]);
            $isEvening = $currentDateTime->gte($eveningStartTime);

            if ($isWeekend && $isEvening) {
                $basePrice = $hallPrice->weekend_evening_price;
            } elseif ($isWeekend) {
                $basePrice = $hallPrice->weekend_price;
            } elseif ($isEvening) {
                $basePrice = $hallPrice->weekday_evening_price;
            } else {
                $basePrice = $hallPrice->weekday_price;
            }

            $totalPrice += $basePrice;

            $currentDateTime->addMinutes($stepBooking);


            if ($currentDateTime->toDateString() !== $startDateTime->toDateString()) {
                $eveningStartTime->addDay();
            }
        }
        if ($totalPrice != (float)$request->totalPrice) {
            return false;
        }

        return true;
    }

    public function delete_bookings(BookingHall $booking)
    {
        $user = Auth::user();
        $isCurrentUser = BookingHall::where('id_user', $user->id)->where('id', $booking->id)->exists();
        $isPartner = $user->id_role == 2;

        if ($isCurrentUser || $isPartner) {
            $nowTime = Carbon::now();
            $startBooking = Carbon::parse($booking->booking_start);

            if ($isPartner || $nowTime->diffInHours($startBooking, false) >= 24) {
                if ($booking->id_unregistered_user) {
                    $booking->minusincome($booking->total_price);
                    $booking->delete();
                    return redirect('/my_booking')->with('success', 'Бронь отменена.');
                } elseif ($isPartner || $this->paymentService->cancelPayment($booking->payment_id)) {
                    $booking->minusincome($booking->total_price);
                    $booking->delete();
                    return redirect('/my_booking')->with('success', 'Бронь отменена.');
                } else {
                    return redirect('/my_booking')->with('error', 'Ошибка при отмене платежа.');
                }
            } else {
                return redirect('/my_booking')->with('error', 'Бронирование можно отменить только за 24 часа.');
            }
        } else {
            return redirect('/my_booking')->with('error', 'Ошибка удаления!');
        }
    }

    public function delete_bookings_for_partner(BookingHall $booking)
    {
        $user = Auth::user();
        $isCurrentUser = BookingHall::where('id_user', $user->id)->where('id', $booking->id)->exists();
        $isPartner = $user->id_role == 2;

        if ($isCurrentUser || $isPartner) {
            $nowTime = Carbon::now();
            $startBooking = Carbon::parse($booking->booking_start);

            if ($isPartner || $nowTime->diffInHours($startBooking, false) >= 24) {
                if ($booking->id_unregistered_user) {
                    $booking->minusincome($booking->total_price);
                    $booking->delete();
                    return response()->json(['success' => 'Бронь отменена.'], 200);
                } elseif ($isPartner || $this->paymentService->cancelPayment($booking->payment_id)) {
                    $booking->minusincome($booking->total_price);
                    $booking->delete();
                    return response()->json(['success' => 'Бронь отменена.'], 200);
                } else {
                    return response()->json(['success' => false, 'message' => 'Ошибка при отмене платежа.'], 400);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Бронирование можно отменить только за 24 часа.'], 400);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Ошибка удаления!'], 400);
        }
    }

    public function payment_bookings($request, $bookingHall)
    {
        $hall = Hall::where('id', $request->selectedHall)->first();
        $amount = $request->totalPrice;
        $orderId = $bookingHall->id;
        $description = $hall->name_hall . ' ' . '(' . $hall->area_hall . ' кв. м' . ') | Дата: ' . $request->selectedDate . ' | Время: ' . $request->selectedTime;

        $paymentUrl = $this->paymentService->makePayment($amount, $orderId, $description);

        return $paymentUrl ?: false;

    }

    public function callback(Request $request)
    {
        $data = $request->all();

        if ($data['Status'] == 'CONFIRMED') {

            $booking = BookingHall::where('id', $data['OrderId'])->first();

            if ($booking->payment_id) {
                return response()->json(['Success' => false, 'Error' => 'Payment already processed'], 400);
            }

            if ($booking) {
                $booking->payment_id = $data['PaymentId'];
                $booking->link_payment = null;
                $booking->save();
                $booking->income($data['Amount'] / 100);

                Mail::to($booking->user->email)->send(new receiptBooking($booking));

                return response()->json(['Success' => true]);
            } else {
                return response()->json(['Success' => false, 'Error' => 'Booking not found'], 400);
            }
        } else {

            return response()->json(['Success' => false, 'Error' => 'Invalid status'], 400);
        }
    }

    public function payment_successful()
    {
        if (Session::has('payment_check')) {
            Session::forget('payment_check');
            return view('payment_successful');
        }
        return redirect('/my_booking');

    }

    public function payment_failed()
    {
        if (Session::has('payment_check')) {
            Session::forget('payment_check');
            return view('payment_failed');
        }
        return redirect('/my_booking');
    }

    public function for_partner(Request $request)
    {
        try {
            if ($request->closeForBooking) {

                $request->validate([
                    'selectedHall' => 'required',
                    'selectedDate' => 'required',
                    'selectedTime' => 'required',
                ], [
                    'selectedDate' => 'Выберите дату!',
                    'selectedTime' => 'Выберите время!',
                ]);

                $dates = explode(', ', $request->selectedDate);
                $times = explode(', ', $request->selectedTime);

                if ($this->closeBooking($request->selectedHall, $dates, $times)) {
                    return response()->json(['success' => 'Зал закрыт для бронирования.', 'close' => true], 200);
                } else {
                    return response()->json(['success' => false, 'message' => 'Произошла ошибка при закрытии зала.', 'close' => false], 400);
                }
            }

            $validated = $request->validate([
                'selectedHall' => 'required',
                'selectedDate' => 'required',
                'selectedTime' => 'required',
                'totalPrice' => 'required',
                'idPriceHall' => 'required',
                'userNameBooking' => 'required',
                'userEmailBooking' => 'required',
                'userPhoneBooking' => 'required',
            ], [
                'selectedDate' => 'Выберите дату!',
                'selectedTime' => 'Выберите время!',
                'userNameBooking' => 'Введите имя!',
                'userEmailBooking' => 'Введите почту!',
                'userPhoneBooking' => 'Введите номер телефона!',
            ]);

            $existingUserForPartner = User::where('phone', $this->normalizePhoneNumber($request->userPhoneBooking))->first();
            $hall = Hall::findOrFail($request->selectedHall);
            $hallPrice = HallPrice::findOrFail($request->idPriceHall);
            $stepBooking = $hall->step_booking * 60; // Шаг бронирования в минутах
            $timezone = 'Asia/Yekaterinburg'; // Часовой пояс
            $userUnregister = false;
            $urlUser = null;

            if (!$existingUserForPartner) {

                $unregisteredUser = UnregisteredUser::where('phone', $this->normalizePhoneNumber($request->userPhoneBooking))
                    ->orWhere('email', $request->userEmailBooking)
                    ->first();

                if (!$unregisteredUser) {
                    $unregisteredUser = UnregisteredUser::create([
                        'name' => $request->userNameBooking,
                        'email' => $request->userEmailBooking,
                        'phone' => $this->normalizePhoneNumber($request->userPhoneBooking),
                    ]);
                }

                $userUnregister = true;
            }

            $dates = explode(', ', $request->selectedDate);
            $times = explode(', ', $request->selectedTime);


            if (count($dates) != count($times)) {
                return response()->json(['error' => 'Ошибка при подсчете времени!'], 400);
            }

            $totalPriceCalculated = 0;

            // Рассчитываем общую стоимость без записи в базу
            foreach ($dates as $index => $date) {
                [$startTime, $endTime] = array_map('trim', explode(' - ', $times[$index]));

                // Получаем дату начала и конца бронирования
                $startDateTime = $this->createDateTime($date, $startTime, $timezone);
                $endDateTime = $this->createDateTime($date, $endTime, $timezone);

                // Проверка на пересекающиеся бронирования
                if ($this->isBookingOverlapping($request->selectedHall, $startDateTime, $endDateTime)) {
                    return response()->json(['error' => 'Данная бронь уже занята!'], 400);
                }

                // Рассчитываем стоимость для текущей даты
                $priceForDay = $this->calculateBookingPrice($startDateTime, $endDateTime, $hall, $hallPrice, $stepBooking);
                $totalPriceCalculated += $priceForDay;

            }

            // Проверяем, совпадает ли общая стоимость с введенной пользователем
            if ($totalPriceCalculated != (float)$request->totalPrice) {
                return response()->json([
                    'error' => 'Рассчитанная стоимость (' . $totalPriceCalculated . ') не совпадает с введенной стоимостью (' . $request->totalPrice . '). Проверьте введенные данные.'
                ], 400);
            }

            $bookingDetails = [];

            foreach ($dates as $index => $date) {
                [$startTime, $endTime] = array_map('trim', explode(' - ', $times[$index]));

                $startDateTime = $this->createDateTime($date, $startTime, $timezone);
                $endDateTime = $this->createDateTime($date, $endTime, $timezone);

                // Создание записи в базе для каждого дня
                $priceForDay = $this->calculateBookingPrice($startDateTime, $endDateTime, $hall, $hallPrice, $stepBooking);

                if ($existingUserForPartner) {

                    $booking = BookingHall::create([
                        'id_hall' => $request->selectedHall,
                        'id_user' => $existingUserForPartner->id,
                        'booking_start' => $startDateTime,
                        'booking_end' => $endDateTime,
                        'total_price' => $priceForDay,
                        'min_people' => $hallPrice->min_people,
                        'max_people' => $hallPrice->max_people,
                        'payment_id' => 1,
                    ]);

                } else {

                    $booking = BookingHall::create([
                        'id_hall' => $request->selectedHall,
                        'id_unregistered_user' => $unregisteredUser->id,
                        'booking_start' => $startDateTime,
                        'booking_end' => $endDateTime,
                        'total_price' => $priceForDay,
                        'min_people' => $hallPrice->min_people,
                        'max_people' => $hallPrice->max_people,
                        'payment_id' => 1,
                    ]);

                }

                $booking->income($priceForDay);
                $booking->hall->increment('count_booking');
                $address = $booking->hall->address_hall;


                $bookingDetails[] = (object)[
                    'id' => $booking->id,
                    'hall' => Hall::find($request->selectedHall),
                    'user' => $existingUserForPartner ? $existingUserForPartner : $unregisteredUser,
                    'booking_start' => $startDateTime,
                    'booking_end' => $endDateTime,
                    'total_price' => $priceForDay,
                    'address' => $address,
                    'created_at' => $booking->created_at,
                    'min_people' => $hallPrice->min_people,
                    'max_people' => $hallPrice->max_people,
                ];


            }

            if (!$userUnregister) {
                $urlUser = route('user.index', ['user' => $existingUserForPartner]);
            }

            $phoneUser = $this->normalizePhoneNumber($request->userPhoneBooking);

            $userEmail = $existingUserForPartner ? $existingUserForPartner->email : $unregisteredUser->email;
            Mail::to($userEmail)->send(new receiptBookingforPartner($bookingDetails));

            return response()->json(['success' => 'Бронирование успешно добавлено!',
                'urlUser' => $urlUser,
                'phoneUser' => $phoneUser,
                'booking' => true,
                'unregister' => $userUnregister,
                'bookingDetails' => $bookingDetails,
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Произошла ошибка: ' . $e->getMessage()], 500);
        }
    }

    private function closeBooking($hallId, $dates, $times)
    {
        $timezone = 'Asia/Yekaterinburg';

        if (count($dates) !== count($times)) {
            return false;
        }

        try {
            foreach ($dates as $index => $date) {
                [$startTime, $endTime] = array_map('trim', explode(' - ', $times[$index]));

                $startDateTime = $this->createDateTime($date, $startTime, $timezone);
                $endDateTime = $this->createDateTime($date, $endTime, $timezone);

                $booking = BookingHall::create([
                    'id_hall' => $hallId,
                    'booking_start' => $startDateTime,
                    'booking_end' => $endDateTime,
                    'payment_id' => 2,
                    'is_available' => 0
                ]);

            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


    private function createDateTime($date, $time, $timezone)
    {
        $dateTime = Carbon::createFromFormat('d.m.Y H:i', "{$date} {$time}", $timezone);
        if ($dateTime->lt(Carbon::now())) {
            $dateTime->addDay(); // Добавляем день, если время конца меньше начала
        }
        return $dateTime;
    }

    private function isBookingOverlapping($hallId, $startDateTime, $endDateTime)
    {
        return BookingHall::where('id_hall', $hallId)
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->where('booking_start', '<', $endDateTime)
                    ->where('booking_end', '>', $startDateTime);
            })->exists();
    }

    private function calculateBookingPrice($startDateTime, $endDateTime, $hall, $hallPrice, $stepBooking)
    {
        $currentDateTime = $startDateTime->copy();
        $eveningStartTime = $startDateTime->copy()->setTimeFromTimeString($hall->time_evening);
        $totalPrice = 0;

        while ($currentDateTime->lt($endDateTime)) {
            $isWeekend = in_array($currentDateTime->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY]);
            $isEvening = $currentDateTime->gte($eveningStartTime);

            $basePrice = $isWeekend
                ? ($isEvening ? $hallPrice->weekend_evening_price : $hallPrice->weekend_price)
                : ($isEvening ? $hallPrice->weekday_evening_price : $hallPrice->weekday_price);

            $totalPrice += $basePrice;
            $currentDateTime->addMinutes($stepBooking);

            // Перенос времени на следующий день, если пересекаем полночь
            if ($currentDateTime->toDateString() !== $startDateTime->toDateString()) {
                $eveningStartTime->addDay();
            }
        }

        return $totalPrice;
    }

    public function unlock(Request $request)
    {
        $data = $request->validate([
            'cells' => 'required|array|min:1',
            'cells.*.date' => 'required|date',
            'cells.*.time' => 'required|date_format:H:i',
            'hall_id' => 'required|integer'
        ]);

        $hall = Hall::findOrFail($data['hall_id']);
        $bookingStepInMinutes = (int)round($hall->step_booking * 60); // Преобразуем шаг в целое число минут

        $unlockedCells = [];
        $errors = [];

        foreach ($data['cells'] as $cell) {
            $unlockTime = Carbon::parse("{$cell['date']} {$cell['time']}");

            $booking = BookingHall::where('id_hall', $data['hall_id'])
                ->where('booking_start', '<=', $unlockTime)
                ->where('booking_end', '>', $unlockTime)
                ->first();

            if ($booking) {
                $bookingStart = Carbon::parse($booking->booking_start);
                $bookingEnd = Carbon::parse($booking->booking_end);

                $remainingDuration = $bookingStart->diffInMinutes($bookingEnd);

                try {
                    if ($remainingDuration == $bookingStepInMinutes) {
                        $booking->disableEvents = true;
                        $booking->delete();
                        $unlockedCells[] = ['date' => $cell['date'], 'time' => $cell['time']];
                    } elseif ($unlockTime->eq($bookingStart)) {
                        // Разблокировка первой ячейки
                        $booking->booking_start = $unlockTime->addMinutes($bookingStepInMinutes);
                        $booking->save();
                        $unlockedCells[] = ['date' => $cell['date'], 'time' => $cell['time']];
                    } elseif ($unlockTime->copy()->addMinutes($bookingStepInMinutes)->eq($bookingEnd)) {
                        // Разблокировка последней ячейки
                        $booking->booking_end = $unlockTime;
                        $booking->save();
                        $unlockedCells[] = ['date' => $cell['date'], 'time' => $cell['time']];
                    } else {
                        // Разблокировка ячейки в середине диапазона, разделение записи
                        BookingHall::create([
                            'id_hall' => $booking->id_hall,
                            'booking_start' => $bookingStart,
                            'booking_end' => $unlockTime,
                            'payment_id' => $booking->payment_id,
                            'is_available' => 0
                        ]);

                        $booking->booking_start = $unlockTime->addMinutes($bookingStepInMinutes);
                        $booking->save();
                        $unlockedCells[] = ['date' => $cell['date'], 'time' => $cell['time']];
                    }

                    if ($booking->booking_start == $booking->booking_end) {
                        $booking->disableEvents = true;
                        $booking->delete();
                        $unlockedCells[] = ['date' => $cell['date'], 'time' => $cell['time']];
                    }
                } catch (\Exception $e) {
                    $errors[] = [
                        'date' => $cell['date'],
                        'time' => $cell['time'],
                        'error' => $e->getMessage()
                    ];
                }
            } else {
                $errors[] = [
                    'date' => $cell['date'],
                    'time' => $cell['time'],
                    'error' => 'Бронирование не найдено'
                ];
            }
        }

        return response()->json([
            'message' => count($unlockedCells) > 0 ? 'Выбранные ячейки успешно разблокированы' : 'Не удалось разблокировать ячейки',
            'unlockedCells' => $unlockedCells,
            'errors' => $errors
        ], count($unlockedCells) > 0 ? 200 : 404);
    }

}
