<?php

namespace App\Http\Controllers;

use App\Models\BookingHall;
use App\Models\Hall;
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
            BookingHall::create([
                'id_hall' => $request->selectedHall,
                'id_user' => $user->id,
                'booking_start' => $startDateTime,
                'booking_end' => $endDateTime,
                'total_price' => $request->totalPrice,
                'count_people_booking' => $request->countPeople,
            ]);

            return redirect('/')->with('success', 'Успешное бронирование!');
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
        $currentDateTime = $startDateTime->copy();
        $peopleCount = $request->input('countPeople');


        switch ($peopleCount) {
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

        while ($currentDateTime->lt($endDateTime)) {
            $isWeekend = in_array($currentDateTime->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY]);
            $isEvening = $currentDateTime->hour >= $hall->time_evening;

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
        }

        if ($totalPrice != $request->totalPrice) {
            return false;
        }

        return true;
    }

}
