<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Заполните поле.',
            'email.email' => 'Введите адрес электронной почты.',
        ]);

        $existingToken = DB::table('password_resets')
            ->where('email', $request->email)
            ->first();

        if ($existingToken) {
            $token = $existingToken->token;
        } else {
            $token = sha1(time() . $request->email);
        }

        $existingUser = DB::table('users')->where('email', $request->email)->first();

        if ($existingUser) {
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]);

            $resetLink = url("/reset-password/{$token}");

            Mail::to($request->email)->send(new ResetPassword($resetLink));

            return back()->with('message', 'Письмо с инструкциями по сбросу пароля отправлено на вашу почту.');
        } else {
            return back()->with('message_error', 'Пользователя с такой почтой не существует.');
        }
    }

    public function showResetForm($token)
    {
        $password = DB::table('password_resets')->where('token', $token)->exists();

        if ($password) {
            return view('forgot_password.reset_password', ['token' => $token]);
        } else {
            return abort(401, 'Недействительный токен!');
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6',
            'confirmpassword' => 'required|min:6|same:password',
        ], [
            'token.required' => 'Отуствует токен.',
            'password.required' => 'Введите новый пароль.',
            'confirmpassword.required' => 'Подтвердите пароль.',
            'password.min' => 'Минимальная длина пароля - 6 символов.',
            'confirmpassword.min' => 'Минимальная длина пароля - 6 символов.',
            'confirmpassword.same' => 'Пароли на совпадают.',
        ]);

        $passwordReset = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$passwordReset) {
            return back()->with('tokenError', 'Неверный токен для сброса пароля');
        } else {
            $user = User::where('email', $passwordReset->email)->first();

            if (!$user) {
                return back()->with('userError', 'Пользователь не найден');
            } else {
                $user->password = Hash::make($request->password);
                $user->save();

                DB::table('password_resets')->where('email', $user->email)->delete();

                return redirect('/')->with('success', 'Пароль успешно изменен!');
            }
        }
    }
}
