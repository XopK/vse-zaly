<?php

namespace App\Http\Controllers;

use App\Models\PartnerRequest;
use App\Rules\UniqueEmailPartnerRequest;
use App\Rules\UniquePhonePartnerRequest;
use App\Traits\PhoneNormalizerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'phoneReq.regex' => 'Номер телефона должен быть в формате +7(xxx)-xxx-xxxx.',
            'passwordReq.required' => 'Введите пароль.',
            'passwordReq.min' => 'Минимальная длина пароля - 6 символов.',
            'confirmPasswordReq.required' => 'Подтвердите пароль.',
            'confirmPasswordReq.same' => 'Пароли на совпадают.',
        ]);

        $application = PartnerRequest::create([
            'email' => $request->emailReq,
            'name' => $request->nameReq,
            'name_studio' => $request->nameStudio,
            'phone' => $this->normalizePhoneNumber($request->phoneReq),
            'password' => Hash::make($request->passwordReq),
        ]);

        if ($application) {
            return redirect('/')->with('success_application', 'Заявка успешно подана!');
        } else {
            return redirect()->back()->with('error_application', 'Ошибка подачи заявки!');
        }
    }
}
