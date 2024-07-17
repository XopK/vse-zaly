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
            'code' => 'required|integer'
        ], [
            'code.required' => 'Введите код.',
            'code.integer' => 'Введите только цифры',
        ]);

        $storedCode = Session::get('verification_code');

        if ($request->code == $storedCode) {

            $expiration = Session::get('verification_code_expires_at');

            if (now()->lt($expiration)) {

                Session::forget('verification_code');
                Session::forget('verification_code_expires_at');

                $user = Auth::user();
                $user->email_verified_at = now();
                $user->save();

                return redirect('/profile')->with('succes_verify', 'Вы успешно подтвердили почту!');
            } else {
                return redirect()->back()->with('error_verify', 'Срок действия кода истек. Запросите новый код.');
            }
        } else {
            return redirect()->back()->with('error_verify', 'Неверный код верификации!');
        }
    }
}
