<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\PhoneNormalizerTrait;
use App\Traits\putSocialLinksTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use PDO;

class AuthController extends Controller
{
    use PhoneNormalizerTrait;
    use putSocialLinksTrait;

    public function sign_up(Request $request)
    {
        $request->merge([
            'signupphone' => $this->normalizePhoneNumber($request->signupphone)
        ]);

        $validated = $request->validate([
            'signupemail' => 'required|email|unique:users,email',
            'signupusername' => 'required|regex:/^[а-яёА-ЯЁ\s]+$/u',
            'signupphone' => 'required|unique:users,phone',
            'signuppassword' => 'required|min:6',
            'signupcpassword' => 'required|same:signuppassword',
            'tg' => 'nullable',
            'vk' => 'nullable',
            'inst' => 'nullable',
        ], [
            'signupemail.required' => 'Введите адрес электронной почты.',
            'signupemail.email' => 'Введите корректный адрес электронной почты.',
            'signupemail.unique' => 'Пользователь с такой почтой уже зарегистрирован.',
            'signupusername.required' => 'Введите имя.',
            'signupusername.regex' => 'Только русские символы.',
            'signupphone.required' => 'Введите номер телефона.',
            'signupphone.unique' => 'Пользователь с таким номером телефона уже зарегистрирован',
            'signuppassword.required' => 'Введите пароль.',
            'signuppassword.min' => 'Минимальная длина пароля - 6 символов.',
            'signupcpassword.required' => 'Подтвердите пароль.',
            'signupcpassword.same' => 'Пароли на совпадают.',
        ]);

        $socialLinks = $this->putSocialLink($request);

        $user = new User([
            'name' => $request->signupusername,
            'phone' => $this->normalizePhoneNumber($request->signupphone),
            'email' => $request->signupemail,
            'password' => Hash::make($request->signuppassword),
            'telegram' => $socialLinks->tg ?? null,
            'vk' => $socialLinks->vk ?? null,
            'instagram' => $socialLinks->inst ?? null,
        ]);

        if ($user) {
            Session::put('user', $user);
            return redirect('/verify_phone');
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
            if (Auth::user()->id_role == 3) {
                return redirect('/admin');
            }
            return redirect('/')->with('success', 'Авторизация прошла успешно!');
        } else {
            return redirect()->back()->with('error_signin', 'Проверьте введеные данные.');
        }
    }
}
