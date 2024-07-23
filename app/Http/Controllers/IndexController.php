<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index_view()
    {
        $studios = Studio::limit(6)->get();
        return view('index', ['studios' => $studios]);
    }
}
