<?php

namespace App\Http\Controllers;

use App\Mail\VerfyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ConfirmEmailController extends Controller
{
    public function get_code()
    {
        $verificationCode = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $expiration = now()->addMinutes(15);

        Session::put('verification_code', $verificationCode);
        Session::put('verification_code_expires_at', $expiration);

        $user = Auth::user();

        Mail::to($user->email)->send(new VerfyEmail($verificationCode));

        return response()->json(['message' => 'Письмо с кодом верификации отправлено'], 200);
    }

    public function verifyEmail(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required'
        ], [
            'code.required' => 'Введите код.'
        ]);

        $storedCode = Session::get('verification_code');

        if ($request->code == $storedCode) {

            $expiration = Session::get('verification_code_expires_at');

            if (now()->lt($expiration)) {

                $user = Auth::user();
                $user->email_verified_at = now();
                $user->save();

                Session::forget('verification_code');
                Session::forget('verification_code_expires_at');
                return redirect('/profile')->with('success', 'Вы успешно подтвердили почту!');
            } else {
                Session::forget('verification_code');
                Session::forget('verification_code_expires_at');
                return redirect()->back()->with('error', 'Срок действия кода истек. Запросите новый код.');
            }
        } else {
            Session::forget('verification_code');
            Session::forget('verification_code_expires_at');
            return redirect()->back()->with('error', 'Неверный код верификации!');
        }
    }
}
