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
    public function sign_up(Request $request)
    {
        $validated = $request->validate([
            'signupemail' => 'required|email|unique:users,email',
            'signupusername' => 'required|regex:/^[а-яёА-ЯЁ\s]+$/u',
            'signupphone' => 'required|regex:/^\+7\(\d{3}\)-\d{3}-\d{4}$/',
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
            'signuppassword.required' => 'Введите пароль.',
            'signuppassword.min' => 'Минимальная длина пароля - 6 символов.',
            'signupcpassword.required' => 'Подтвердите пароль.',
            'signupcpassword.same' => 'Пароли на совпадают.',
        ]);

        $user = User::create([
            'name' => $request->signupusername,
            'phone' => $request->signupphone,
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

        if(Auth::attempt([
            'emailOrPhone'
        ])){

        }
    }
}
