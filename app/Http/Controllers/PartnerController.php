<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    public function my_halls_profile()
    {
        $halls = Hall::where('id_studio', Auth::user()->studio->id)->get();
        $sum_income = $halls->sum('total_income');
        $total_count_booking = $halls->sum('count_booking');

        return view("my_halls_profile", ['halls' => $halls, 'sum_income' => $sum_income, 'total_count_booking' => $total_count_booking]);
    }

    public function booking_for_partner(Request $request)
    {
        dd($request);
    }
}
