<?php

namespace App\Http\Controllers;

use App\Models\PartnerRequest;
use App\Rules\UniqueEmailPartnerRequest;
use App\Rules\UniquePhonePartnerRequest;
use App\Traits\PhoneNormalizerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    use PhoneNormalizerTrait;

    public function create_application(Request $request)
    {
        $validated = $request->validate([
            'emailReq' => ['required', 'email', new UniqueEmailPartnerRequest],
            'nameReq' => 'required|regex:/^[а-яёА-ЯЁ\s]+$/u',
            'nameStudio' => 'required|min:3',
            'phoneReq' => ['required', 'regex:/^\+7\(\d{3}\)-\d{3}-\d{4}$/', new UniquePhonePartnerRequest],
            'addressStudio' => 'required|min:3',
            'passwordReq' => 'required|min:6',
            'confirmPasswordReq' => 'required|same:passwordReq',
        ], [
            'emailReq.required' => 'Введите адрес электронной почты.',
            'emailReq.email' => 'Введите корректный адрес электронной почты.',
            'nameReq.required' => 'Введите имя.',
            'nameReq.regex' => 'Только русские символы.',
            'nameStudio.required' => 'Введите название студии.',
            'nameStudio.min' => 'Минимальная длина названии студии - 3 символа.',
            'phoneReq.required' => 'Введите номер телефона.',
            'addressStudio.required' => 'Введите адрес студии',
            'addressStudio.min' => 'Минимальная длина адреса - 3 символа',
            'phoneReq.regex' => 'Номер телефона должен быть в формате +7(xxx)-xxx-xxxx.',
            'passwordReq.required' => 'Введите пароль.',
            'passwordReq.min' => 'Минимальная длина пароля - 6 символов.',
            'confirmPasswordReq.required' => 'Подтвердите пароль.',
            'confirmPasswordReq.same' => 'Пароли на совпадают.',
        ]);

        $application = new PartnerRequest([
            'email' => $request->emailReq,
            'name' => $request->nameReq,
            'address' => $request->addressStudio,
            'name_studio' => $request->nameStudio,
            'phone' => $this->normalizePhoneNumber($request->phoneReq),
            'password' => Hash::make($request->passwordReq),
        ]);

        if ($application) {
            Session::put('application', $application);
            return redirect('/verify_phone_partner');
        } else {
            return redirect()->back()->with('error', 'Ошибка подачи заявки!');
        }
    }

    public function create_application_auth(Request $request)
    {
        $validated = $request->validate([
            'nameStudio' => 'required|min:3',
            'addressStudio' => 'required|min:3',
        ], [
            'nameStudio.required' => 'Введите название студии.',
            'nameStudio.min' => 'Минимальная длина названии студии - 3 символа.',
            'addressStudio.required' => 'Введите адрес студии',
            'addressStudio.min' => 'Минимальная длина адреса - 3 символа',
        ]);

        $user = Auth::user();
        $requests = PartnerRequest::where('id_user', $user->id)->exists();

        if ($requests) {
            return back()->with('error', 'Вы уже подали заявку!');
        }

        $application = PartnerRequest::create([
            'id_user' => $user->id,
            'name_studio' => $request->nameStudio,
            'address' => $request->addressStudio,
        ]);

        if ($application) {
            return redirect('/')->with('success', 'Заявка подана!');
        } else {
            return redirect()->back()->with('error', 'Ошибка подачи заявки!');
        }
    }
}
