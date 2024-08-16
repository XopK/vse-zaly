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

        return view("my_halls_profile", ['halls' => $halls]);
    }
}
