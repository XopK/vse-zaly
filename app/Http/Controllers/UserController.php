<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private function normalizePhoneNumber($phone)
    {
        $digits = preg_replace('/\D/', '', $phone);

        if (substr($digits, 0, 1) == '8') {
            $digits = '7' . substr($digits, 1);
        } elseif (substr($digits, 0, 1) == '7') {
            // Ничего не делаем, номер уже начинается с '7'
        } else {
            return null;
        }
        return '+7' . substr($digits, 1);
    }

    public function update_data(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|regex:/^[а-яёА-ЯЁ\s]+$/u|',
            'phone' => 'required|unique:users,phone,' . Auth::user()->id,
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
        ]);

        $user = User::find(Auth::user()->id);

        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $this->normalizePhoneNumber($request->phone),
        ]);

        if ($user) {
            $user->save();
            return redirect()->back()->with('success', 'Данные изменены');
        } else {
            return redirect()->back()->with('error', 'Ошибка');
        }
    }
}
