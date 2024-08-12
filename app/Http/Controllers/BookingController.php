<?php

namespace App\Http\Controllers;

use App\Models\BookingHall;
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

        $booking = BookingHall::create([
            'id_hall' => $request->selectedHall,
            'id_user' => $user->id,
            'booking_start' => $startDateTime,
            'booking_end' => $endDateTime,
            'total_price' => $request->totalPrice,
        ]);

        if ($booking) {
            return redirect('/')->with('succes', 'Успешное бронирование!');
        } else {
            return back()->with('error', 'Ошибка бронирования!');
        }
    }
}
