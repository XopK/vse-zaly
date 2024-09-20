<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index_view()
    {
        $studios = Studio::all();
        return view('index', ['studios' => $studios]);
    }

    public function about_view()
    {
        $studios = Studio::limit(3)->get();
        return view('about', ['studios' => $studios]);
    }
}
