<?php

namespace App\Http\Controllers;

use App\Models\BookingHall;
use App\Models\Hall;
use App\View\Components\booking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create_booking(Request $request)
    {
        $validated = $request->validate([
            'selectedHall' => 'required',
            'selectedDate' => 'required',
            'selectedTime' => 'required',
            'totalPrice' => 'required',
            'countPeople' => 'required',
        ]);

        $user = Auth::user();

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
                'count_people_booking' => $request->countPeople,
            ]);

            $bookingHall->income($request->totalPrice);

            return redirect('/my_booking')->with('success', 'Успешное бронирование!');
        } else {
            return back()->with('error', 'Ошибка бронирования!');
        }
    }

    private function checkUserBooking($request, $startDateTime, $endDateTime)
    {
        $hall = Hall::find($request->selectedHall);

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


        switch ($request->countPeople) {
            case 2:
                $peoplePrice = $hall->price_for_two;
                break;
            case 4:
                $peoplePrice = $hall->price_for_four;
                break;
            case 7:
                $peoplePrice = $hall->price_for_seven;
                break;
            case 10:
                $peoplePrice = $hall->price_for_nine;
                break;
            default:
                $peoplePrice = 0;
                break;
        }

        // Цикл расчета стоимости бронирования
        $currentDateTime = $startDateTime->copy();
        $eveningStartTime = $currentDateTime->copy()->setTimeFromTimeString($hall->time_evening);

        while ($currentDateTime->lt($endDateTime)) {
            $isWeekend = in_array($currentDateTime->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY]);
            $isEvening = $currentDateTime->gte($eveningStartTime);

            if ($isWeekend && $isEvening) {
                $basePrice = $hall->max_price;
            } elseif ($isWeekend) {
                $basePrice = $hall->price_weekend;
            } elseif ($isEvening) {
                $basePrice = $hall->price_evening;
            } else {
                $basePrice = $hall->price_weekday;
            }

            $finalPrice = $basePrice + $peoplePrice;
            $totalPrice += $finalPrice;

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

                $booking->delete();
                return redirect('/my_booking')->with('success_delete', 'Бронь отменена.');

            } else {
                return redirect('/my_booking')->with('error_delete', 'Бронирование можно отменить только за 24 часа.');
            }
        } else {
            return redirect('/my_booking')->with('error_delete', 'Ошибка удаления!');
        }
    }


}
