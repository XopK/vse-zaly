<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use PDO;

class AuthController extends Controller
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

    public function sign_up(Request $request)
    {
        $validated = $request->validate([
            'signupemail' => 'required|email|unique:users,email',
            'signupusername' => 'required|regex:/^[а-яёА-ЯЁ\s]+$/u',
            'signupphone' => 'required|regex:/^\+7\(\d{3}\)-\d{3}-\d{4}$/|unique:users,phone',
            'signuppassword' => 'required|min:6',
            'signupcpassword' => 'required|same:signuppassword',
        ], [
            'signupemail.required' => 'Введите адрес электронной почты.',
            'signupemail.email' => 'Введите корректный адрес электронной почты.',
            'signupemail.unique' => 'Пользователь с такой почтой уже зарегистрирован.',
            'signupusername.required' => 'Введите имя.',
            'signupusername.regex' => 'Только русские символы.',
            'signupphone.required' => 'Введите номер телефона.',
            'signupphone.regex' => 'Номер телефона должен быть в формате +7(xxx)-xxx-xxxx.',
            'signupphone.unique' => 'Пользователь с таким номером телефона уже зарегистрирован',
            'signuppassword.required' => 'Введите пароль.',
            'signuppassword.min' => 'Минимальная длина пароля - 6 символов.',
            'signupcpassword.required' => 'Подтвердите пароль.',
            'signupcpassword.same' => 'Пароли на совпадают.',
        ]);

        $user = User::create([
            'name' => $request->signupusername,
            'phone' => $this->normalizePhoneNumber($request->signupphone),
            'email' => $request->signupemail,
            'password' => Hash::make($request->signuppassword),
        ]);

        if ($user) {
            Auth::login($user);
            return redirect('/')->with('success', 'Вы успешно зарегистрировались!');
        } else {
            return redirect()->back()->with('error', 'Ошибка регистрации');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    public function sign_in(Request $request)
    {
        $validated = $request->validate([
            'emailOrPhone' => 'required',
            'password' => 'required|min:6'
        ], [
            'emailOrPhone.required' => 'Введите номер телефона или почту.',
            'password.required' => 'Введите пароль.',
            'password.min' => 'Минимальная длина пароля - 6 символов.',
        ]);

        $field = filter_var($request->emailOrPhone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if ($field == 'phone') {
            $normalizedPhone = $this->normalizePhoneNumber($request->emailOrPhone);
        }

        if (Auth::attempt([
            $field => ($field == 'phone') ? $normalizedPhone : $request->emailOrPhone,
            'password' => $request->password,
        ], $request->has('remember'))) {
            return redirect('/')->with('success', 'Авторизация прошла успешно!');
        } else {
            return redirect()->back()->with('error_signin', 'Проверьте введеные данные.');
        }
    }
}
