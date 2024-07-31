<?php

namespace App\Http\Controllers;

use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SmsController extends Controller
{

    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function sms_verify()
    {
        $user = Session::get('user');

        $verificationCode = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $expiration = now()->addMinutes(15);

        Session::put('verification_code_sms', $verificationCode);
        Session::put('verification_code_sms_expires_at', $expiration);


        $params = [
            'number' => ltrim($user->phone, '+'),
            'text' => "Ваш код подтверждения: $verificationCode",
        ];

        $response = $this->smsService->sendSms($params['number'], $params['text']);


        return view('sms', ['user' => $user]);
    }

    public function check_code(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required'
        ], [
            'code.required' => 'Введите код.',
        ]);

        $storedCode = Session::get('verification_code_sms');

        if ($request->code == $storedCode) {

            $expiration = Session::get('verification_code_sms_expires_at');

            if (now()->lt($expiration)) {

                $user = Session::get('user');
                $user->phone_verfied = now();
                $user->save();

                Auth::login($user);

                Session::forget('verification_code_sms');
                Session::forget('verification_code_sms_expires_at');
                return redirect('/')->with('success', 'Успешная регистрация!');
            } else {
                Session::forget('verification_code_sms');
                Session::forget('verification_code_sms_expires_at');
                return redirect()->back()->with('error', 'Срок действия кода истек. Запросите новый код.');
            }
        } else {
            Session::forget('verification_code_sms');
            Session::forget('verification_code_sms_expires_at');
            return redirect()->back()->with('error_verify', 'Неверный код верификации!');
        }
    }
}
