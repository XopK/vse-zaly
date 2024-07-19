<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HallController extends Controller
{
    public function my_halls()
    {
        return view('my_halls');
    }

    public function create_halls(Request $request)
    {
//        $validated = $request->validate([
//
//        ]);
    }
}
