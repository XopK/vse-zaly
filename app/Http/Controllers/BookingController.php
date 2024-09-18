<?php

namespace App\Http\Controllers;

use App\Models\BookingHall;
use App\Models\Hall;
use App\Models\HallPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PaymentService;


class BookingController extends Controller
{

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
        $eveningStartTime = $currentDateTime->copy()->setTimeFromTimeString('18:00');

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

        if ($user->id_role == 2) {
            $isCurrentUser = true;
        }

        if ($isCurrentUser) {
            $nowTime = Carbon::now();
            $startBooking = Carbon::parse($booking->booking_start);

            if ($nowTime->diffInHours($startBooking, false) >= 24) {

                if ($this->paymentService->cancelPayment($booking->payment_id)) {
                    $booking->minusincome($booking->total_price);
                    $booking->delete();
                    return redirect('/my_booking')->with('success_delete', 'Бронь отменена.');
                } else {
                    return redirect('/my_booking')->with('success_delete', 'Бронь отменена.');
                }
            } else {
                return redirect('/my_booking')->with('error_delete', 'Бронирование можно отменить только за 24 часа.');
            }
        } else {
            return redirect('/my_booking')->with('error_delete', 'Ошибка удаления!');
        }
    }

    public function payment_bookings($request, $bookingHall)
    {
        $hall = Hall::where('id', $request->selectedHall)->first();

        $amount = $request->totalPrice;
        $orderId = $bookingHall->id;
        $description = $hall->name_hall . ' ' . '(' . $hall->area_hall . 'кв. м' . ')';

        $paymentUrl = $this->paymentService->makePayment($amount, $orderId, $description);

        return $paymentUrl ?: false;

    }

    public function callback(Request $request)
    {
        $data = $request->all();

        if ($data['Status'] == 'CONFIRMED') {

            $booking = BookingHall::where('id', $data['OrderId'])->first();

            if ($booking) {
                $booking->payment_id = $data['PaymentId'];
                $booking->save();
                $booking->income($data['Amount'] / 100);

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
        return view('payment_successful');
    }

    public function payment_failed()
    {
        return view('payment_failed');
    }

    public function for_partner(Request $request)
    {
        
        $validated = $request->validate([
            'selectedHall' => 'required',
            'selectedDate' => 'required',
            'selectedTime' => 'required',
            'totalPrice' => 'required',
            'idPriceHall' => 'required',
        ]);

        $user = Auth::user();
        $hallPrice = HallPrice::find($request->idPriceHall);

        $dates = explode(', ', $request->selectedDate);
        $times = explode(', ', $request->selectedTime);

        if (count($dates) != count($times)) {
            return back()->withErrors(['selectedDate' => 'Количество дат и временных интервалов не совпадает.']);
        }


    }

}
