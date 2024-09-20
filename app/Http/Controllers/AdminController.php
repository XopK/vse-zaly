<?php

namespace App\Http\Controllers;

use App\Models\BookingHall;
use App\Models\Hall;
use App\Models\PartnerRequest;
use App\Models\Studio;
use App\Models\User;
use App\View\Components\booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $halls = Hall::all();
        return view('admin.index', ['halls' => $halls]);
    }

    public function users()
    {
        $users = User::all();

        return view('admin.users', ['users' => $users]);
    }

    public function studios()
    {
        $studios = Studio::all();

        return view('admin.studios', ['studios' => $studios]);
    }

    public function booking()
    {
        $bookings = BookingHall::whereNotNull('payment_id')->get();
        return view('admin.booking', ['bookings' => $bookings]);
    }

    public function studio_requests()
    {
        $studios = count(Studio::all());
        $requests = PartnerRequest::all();

        return view('admin.studio_requests', ['requests' => $requests, 'studios' => $studios]);
    }

    public function studio_request_response(PartnerRequest $id, Request $request)
    {
        if ($request->response == 'apply') {

            $user = User::create([
                'name' => $id->name,
                'phone' => $id->phone,
                'phone_verfied' => now(),
                'email' => $id->email,
                'password' => $id->password,
                'id_role' => 2,
            ]);

            $studio = Studio::create([
                'name_studio' => $id->name_studio,
                'description_studio' => 'Описание студии',
                'email_studio' => $id->email,
                'phone_studio' => $id->phone,
                'adress_studio' => $id->address,
                'id_user' => $user->id,
            ]);

            $id->delete();

            return redirect()->back()->with('success', 'Заявка была принята!');
        }

        if ($request->response == 'deny') {
            $id->delete();

            return redirect()->back()->with('success', 'Заявка была отклонена!');
        }

        return redirect()->back()->with('error', 'Ошибка!');
    }
    
}
