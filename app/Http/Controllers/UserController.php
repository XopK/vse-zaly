<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\PhoneNormalizerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use PhoneNormalizerTrait;

    public function update_data(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|regex:/^[а-яёА-ЯЁ\s]+$/u|',
            'phone' => 'required|regex:/^\+7\(\d{3}\)-\d{3}-\d{4}$/|unique:users,phone,' . Auth::user()->id,
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'photo_user' => 'image|max:2048',
        ], [
            'name.required' => 'Имя должно быть заполенено.',
            'name.regex' => 'Только русские символы.',
            'phone.required' => 'Номер телефона должен быть заполнен.',
            'phone.regex' => 'Номер телефона должен быть в формате +7(xxx)-xxx-xxxx.',
            'phone.unique' => 'Данный номер телефона уже занят.',
            'email.required' => 'Введите адрес электронной почты.',
            'email.email' => 'Введите корректный адрес электронной почты.',
            'email.unique' => 'Данный адрес электронной почты уже занят.',
            'photo_user.image' => 'Выберите изображение.',
            'photo_user.max' => 'Максимальный размер изображения не должен превышать :max KB.',
        ]);

        $user = User::find(Auth::user()->id);

        if ($request->file('photo_user')) {
            if ($user->profile_img != 'default.png') {
                Storage::delete('public/users_profile/' . $user->profile_img);
            }
            $hashPhoto = $request->file('photo_user')->hashName();
            $storePhoto = $request->file('photo_user')->store('public/users_profile');
        } else {
            $hashPhoto = $user->profile_img;
        }

        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $this->normalizePhoneNumber($request->phone),
            'photo_profile' => $hashPhoto,
        ]);

        if ($user) {
            $user->save();
            return redirect()->back()->with('success', 'Данные изменены');
        } else {
            return redirect()->back()->with('error', 'Ошибка');
        }
    }

    public function update_password(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required',
            'new_password' => 'required',
            'new_password_confirm' => 'required|same:new_password'
        ]);
    }
}
