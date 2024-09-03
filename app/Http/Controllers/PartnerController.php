<?php

namespace App\Http\Controllers;

use App\Models\BookingHall;
use App\Models\EndDateTimeBooking;
use App\Models\Hall;
use App\Models\User;
use App\Traits\PhoneNormalizerTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    use PhoneNormalizerTrait;

    public function my_halls_profile()
    {
        $halls = Hall::where('id_studio', Auth::user()->studio->id)->get();
        $sum_income = $halls->sum('total_income');
        $total_count_booking = $halls->sum('count_booking');

        return view("my_halls_profile", ['halls' => $halls, 'sum_income' => $sum_income, 'total_count_booking' => $total_count_booking]);
    }

    public function booking_for_partner(Request $request)
    {
        $validated = $request->validate([
            'selectedHall' => 'required|integer',
            'selectedDate' => 'required|string',
            'selectedTime' => 'required|string',
            'totalPrice' => 'required|numeric',
            'countPeople' => 'required|integer',
            'phone_booking' => 'required|string',
        ]);

        $user = User::where('phone', $this->normalizePhoneNumber($request->phone_booking))->firstOrFail();

        $date_formated = array_map('trim', explode(',', $request->selectedDate));
        $dates = array_map(function ($date) {
            return Carbon::createFromFormat('d.m.Y', $date);
        }, $date_formated);

        $firstDate = reset($dates);

        $timeRanges = explode(',', $request->selectedTime);
        $timeIntervals = [];

        foreach ($timeRanges as $timeRange) {
            $times = explode(' - ', trim($timeRange));
            if (count($times) === 2) {
                $timeIntervals[] = [
                    'start' => trim($times[0]),
                    'end' => trim($times[1]),
                ];
            }
        }

        if (empty($timeIntervals)) {
            return redirect()->back()->with('error', 'Неверный формат времени!');
        }

        DB::beginTransaction();

        try {
            $firstInterval = $timeIntervals[0];
            $startDateTime = Carbon::createFromFormat('d.m.Y H:i', $firstDate->format('d.m.Y') . ' ' . $firstInterval['start']);
            $endDateTime = Carbon::createFromFormat('d.m.Y H:i', $firstDate->format('d.m.Y') . ' ' . $firstInterval['end']);

            $bookingHall = BookingHall::create([
                'id_hall' => $request->selectedHall,
                'id_user' => $user->id,
                'booking_start' => $startDateTime,
                'booking_end' => $endDateTime,
                'total_price' => $request->totalPrice,
                'count_people_booking' => $request->countPeople,
            ]);

            $dates = array_slice($dates, 1);

            foreach ($dates as $date) {
                foreach ($timeIntervals as $timeInterval) {
                    $startTimeDate = Carbon::createFromFormat('d.m.Y H:i', $date->format('d.m.Y') . ' ' . $timeInterval['start']);
                    $endDateTime = Carbon::createFromFormat('d.m.Y H:i', $date->format('d.m.Y') . ' ' . $timeInterval['end']);
                }
                EndDateTimeBooking::create([
                    'id_booking' => $bookingHall->id,
                    'booking_start' => $startTimeDate,
                    'booking_end' => $endDateTime,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Произошла ошибка при создании бронирования.');
        }

        return redirect()->back()->with('success', 'Бронирование успешно создано!');
    }


}
