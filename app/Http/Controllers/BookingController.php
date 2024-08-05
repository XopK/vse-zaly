<?php

namespace App\Http\Controllers;

use App\Models\BookingHall;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create_booking(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date_format:d.m.Y',
            'time' => 'required|string'
        ]);

        $dateTime = Carbon::createFromFormat('d.m.Y H:i', $request->date . ' ' . $request->time);

        BookingHall::create([
            'id_hall' => 1,
            'id_user' => Auth::user()->id,
            'datetime_booking' => $dateTime,
        ]);

        return response()->json(['message' => 'Booking successfully created']);
    }
}
