<?php

namespace App\Http\Controllers;

use App\Mail\notificationPartnerRequest;
use App\Models\BookingHall;
use App\Models\Hall;
use App\Models\PartnerRequest;
use App\Models\Studio;
use App\Models\User;
use App\View\Components\booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        $halls = Hall::all();
        return view('admin.index', ['halls' => $halls]);
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users', ['users' => $users]);
    }

    public function studios()
    {
        $studios = Studio::orderBy('created_at', 'desc')->get();

        return view('admin.studios', ['studios' => $studios]);
    }

    public function booking()
    {
        $bookings = BookingHall::where('is_available', 1)->orderBy('created_at', 'desc')->get();
        return view('admin.booking', ['bookings' => $bookings]);
    }

    public function user_booking(User $user)
    {
        $bookings = BookingHall::where('id_user', $user->id)->orderBy('created_at', 'desc')->get();

        return view('admin.user_bookings', ['user' => $user, 'bookings' => $bookings]);
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
            if ($id->id_user == null) {
                $user = User::create([
                    'name' => $id->name,
                    'phone' => $id->phone,
                    'phone_verfied' => now(),
                    'email' => $id->email,
                    'password' => $id->password,
                    'id_role' => 2,
                ]);
            }
            $studio = Studio::create([
                'name_studio' => $id->name_studio,
                'description_studio' => 'Описание студии',
                'email_studio' => $id->email ? $id->email : $id->user->email,
                'phone_studio' => $id->phone ? $id->phone : $id->user->phone,
                'adress_studio' => $id->address,
                'id_user' => $id->id_user ? $id->id_user : $user->id,
            ]);

            $owner = User::find($id->id_user ? $id->id_user : $user->id);

            $owner->id_role = 2;

            $owner->save();

            $id->delete();

            $to = $id->email ? $id->email : $owner->email;

            Mail::to($to)->send(new notificationPartnerRequest(true));

            return redirect()->back()->with('success', 'Заявка была принята!');
        }

        if ($request->response == 'deny') {

            if ($id->email == null) {
                $user_sender = User::find($id->id_user);
            }

            $id->delete();

            $to = $id->email ? $id->email : $user_sender->email;

            Mail::to($to)->send(new notificationPartnerRequest(false));

            return redirect()->back()->with('success', 'Заявка была отклонена!');
        }

        return redirect()->back()->with('error', 'Ошибка!');
    }

}
