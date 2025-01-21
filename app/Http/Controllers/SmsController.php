<?php

namespace App\Http\Controllers;

use App\Models\UnregisteredUser;
use App\Models\User;
use App\Services\SmsService;
use App\Traits\PhoneNormalizerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SmsController extends Controller
{
    use PhoneNormalizerTrait;

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

    public function sms_verify_for_partner()
    {
        $partner = Session::get('application');

        $verificationCode = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $expiration = now()->addMinutes(15);

        Session::put('verification_code_sms', $verificationCode);
        Session::put('verification_code_sms_expires_at', $expiration);

        $params = [
            'number' => ltrim($partner->phone, '+'),
            'text' => "Ваш код подтверждения: $verificationCode",
        ];

        $response = $this->smsService->sendSms($params['number'], $params['text']);

        return view('sms', ['user' => $partner]);
    }

    public function change_phone(Request $request)
    {
        $validated = $request->validate([
            'changePhone' => 'required|unique:users,phone',
        ]);

        $user = Session::get('user');

        $user['phone'] = $this->normalizePhoneNumber($request->changePhone);

        Session::put('user', $user);

        return $this->sms_verify();
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

                if (Session::has('user')) {
                    $user = Session::get('user');
                    $user->phone_verfied = now();
                    $user->save();

                    $unregistered = UnregisteredUser::where('phone', $user->phone)->orWhere('email', $user->email)->first();

                    if ($unregistered) {

                        $bookingUnregistered = $unregistered->bookings;
                        foreach ($bookingUnregistered as $bo) {
                            $bo->id_unregistered_user = null;
                            $bo->id_user = $user->id;
                            $bo->save();
                        }

                        $cancelledBooking = $unregistered->canceledBookings;
                        foreach ($cancelledBooking as $bo) {
                            $bo->id_unregistered_user = null;
                            $bo->id_user = $user->id;
                            $bo->save();
                        }

                        $unregistered->delete();

                    }

                    Auth::login($user);

                    Session::forget('verification_code_sms');
                    Session::forget('verification_code_sms_expires_at');
                    Session::forget('user');

                    return redirect('/')->with('success', 'Успешная регистрация!');
                } elseif (Session::has('application')) {

                    $partner = Session::get('application');
                    $partner->save();

                    Session::forget('verification_code_sms');
                    Session::forget('verification_code_sms_expires_at');
                    Session::forget('application');

                    return redirect('/')->with('success', 'Заявка подана!');

                } elseif (Session::has('update_phone_user')) {

                    $user_update = Session::get('update_phone_user');
                    $user = Auth::user();
                    $user->phone = $user_update;
                    $user->save();

                    Session::forget('verification_code_sms');
                    Session::forget('verification_code_sms_expires_at');
                    Session::forget('update_phone_user');

                    return redirect('/profile')->with('success', 'Номер обновлен');
                }

            } else {
                Session::forget('verification_code_sms');
                Session::forget('verification_code_sms_expires_at');
                return redirect()->back()->with('error', 'Срок действия кода истек. Запросите новый код.');
            }
        } else {
            return redirect()->back()->with('error', 'Неверный код верификации!');
        }
    }
}
