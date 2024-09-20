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



}
