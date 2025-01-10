<?php

namespace App\Http\Controllers;

use App\Mail\VerfyEmail;
use App\Models\BookingHall;
use App\Models\FavoriteHall;
use App\Models\ReportUser;
use App\Models\User;
use App\Services\SmsService;
use App\Traits\PhoneNormalizerTrait;
use App\Traits\putSocialLinksTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use PhoneNormalizerTrait;
    use putSocialLinksTrait;

    protected $smsService;

    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function update_data(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|regex:/^[а-яёА-ЯЁ\s]+$/u|',
            'phone' => 'required|regex:/^\+7\(\d{3}\)-\d{3}-\d{4}$/|unique:users,phone,' . Auth::user()->id,
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'tg' => 'nullable',
            'vk' => 'nullable',
            'inst' => 'nullable',
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

        if ($request->file('photo_user') != null) {
            if ($user->photo_profile != 'default.png') {
                Storage::delete('public/users_profile/' . $user->photo_profile);
            }
            $hashPhoto = $request->file('photo_user')->hashName();
            $storePhoto = $request->file('photo_user')->store('public/users_profile');
        } else {
            $hashPhoto = $user->photo_profile;
        }

        if ($user->phone != $this->normalizePhoneNumber($request->phone)) {

            $verificationCode = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $expiration = now()->addMinutes(15);

            Session::put('verification_code_sms', $verificationCode);
            Session::put('verification_code_sms_expires_at', $expiration);

            $params = [
                'number' => ltrim($request->phone, '+'),
                'text' => "Ваш код подтверждения: $verificationCode",
            ];

            Session::put('update_phone_user', $request->phone);

            $response = $this->smsService->sendSms($params['number'], $params['text']);

            return view('sms', ['user' => $request]);
        }

        if ($user->email != $request->email) {
            Session::put('new_email', $request->email);
            return redirect(route('view_email'));
        } else {
            if ($request->tg || $request->vk || $request->inst) {
                $socialLinks = $this->putSocialLink($request);
            }

            $user->fill([
                'name' => $request->name,
                'phone' => $this->normalizePhoneNumber($request->phone),
                'photo_profile' => $hashPhoto,
                'telegram' => $socialLinks->tg ?? null,
                'vk' => $socialLinks->vk ?? null,
                'instagram' => $socialLinks->inst ?? null,
            ]);

            if ($user) {
                $user->save();
                return redirect()->back()->with('success', 'Данные изменены');
            } else {
                return redirect()->back()->with('error', 'Ошибка');
            }
        }
    }

    public function update_password(Request $request)
    {
        $validated = $request->validate([
            'password_old' => 'required',
            'new_password' => 'required',
            'new_password_confirm' => 'required|same:new_password'
        ], [
            'password_old.required' => 'Введите старый пароль.',
            'new_password.required' => 'Введите новый пароль.',
            'new_password_confirm.required' => 'Подтвердите пароль.',
            'new_password_confirm.same' => 'Пароли не совпадают.',
        ]);

        $user = Auth::user();

        if (Hash::check($request->password_old, $user->password)) {

            if (Hash::check($request->new_password, $user->password)) {

                return redirect()->back()->with('error_change_password', 'Старый пароль не должен совпадать с новым!');
            } else {

                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->back()->with('success_change_password', 'Пароль успешно изменен!');
            }
        } else {

            return redirect()->back()->with('error_change_password', 'Старый пароль не совпадает!');
        }
    }

    public function new_email_view()
    {
        $verificationCode = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $expiration = now()->addMinutes(15);

        Session::put('verification_code', $verificationCode);
        Session::put('verification_code_expires_at', $expiration);

        $newEmail = Session::get('new_email');

        Mail::to($newEmail)->send(new VerfyEmail($verificationCode));

        return view('new_email');
    }

    public function newEmailChange(Request $request)
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
                $newEmail = Session::get('new_email');

                $user = Auth::user();
                $user->email = $newEmail;
                $user->save();

                Session::forget('verification_code');
                Session::forget('verification_code_expires_at');
                Session::forget('new_email');
                return redirect('/profile')->with('succes_verify', 'Ваша почта изменена!');
            } else {
                Session::forget('verification_code');
                Session::forget('verification_code_expires_at');
                Session::forget('new_email');
                return redirect()->back()->with('error_verify', 'Срок действия кода истек. Запросите новый код.');
            }
        } else {
            Session::forget('verification_code');
            Session::forget('verification_code_expires_at');
            Session::forget('new_email');
            return redirect()->back()->with('error_verify', 'Неверный код верификации!');
        }
    }

    public function my_booking()
    {
        $userId = Auth::user()->id;

        $booking_halls = BookingHall::whereHas('hall.studio', function ($query) use ($userId) {
            $query->where('id_user', $userId);
        })->where('is_available', true)->with('hall.studio', 'user', 'unregister_user')->orderBy('created_at', 'desc')->get();

        $activeBookings = $booking_halls->where('is_archive', 0);
        $archivedBookings = $booking_halls->where('is_archive', 1);


        $bookings_user = BookingHall::where('id_user', $userId)->where('is_archive', 0)->orderBy('created_at', 'desc')->get();

        return view('my_booking', ['active_bookings' => $activeBookings, 'archived_bookings' => $archivedBookings, 'bookings_user' => $bookings_user]);
    }

    public function addToFavorite(Request $request)
    {
        $user = Auth::user();
        $hall = $request->input('item_id');

        $user->favorites()->create(['id_hall' => $hall]);
        return response()->json(['status' => 'added']);
    }

    public function removeFromFavorite(Request $request)
    {
        $user = Auth::user();
        $hall = $request->input('item_id');

        $user->favorites()->where('id_hall', $hall)->delete();
        return response()->json(['status' => 'removed']);

    }

    public function favourite_properties()
    {
        $user = Auth::user();
        $favorites = FavoriteHall::where('id_user', $user->id)->with('halls')->get();

        $favorites->each(function ($favorite) {
            $favorite->is_favorite = true;
        });

        return view('favourite_properties', ['favorites' => $favorites]);
    }

    public function user_profile(User $user)
    {
        return view('user_profile', ['user' => $user]);
    }

    public function user_reports(User $user)
    {
        $reports = ReportUser::where('id_partner', Auth::user()->id)->get();
        return view('user_reports', ['user' => $user, 'reports' => $reports]);
    }

    public function send_report(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_partner' => 'required',
            'reportUser' => 'required',
        ], [
            'id_user.required' => 'Отсутствует пользователь',
            'id_partner.required' => 'Отсутствует пользователь',
            'reportUser.required' => 'Введите заметку.'
        ]);

        $report = ReportUser::create([
            'id_user' => $request->id_user,
            'report' => $request->reportUser,
            'id_partner' => $request->id_partner,
        ]);

        if ($report) {
            return back()->with('success', 'Заметка оставлена!');
        } else {
            return back()->with('error', 'Ошибка!');
        }
    }

    public function cancel_booking_user(Request $request)
    {
        $booking = BookingHall::where('id', $request->id_booking)->first();
        $booking->disableEvents = true;

        $booking->delete();

        return back()->with('success', 'Резерв отменен!');
    }

}
