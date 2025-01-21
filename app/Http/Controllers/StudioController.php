<?php

namespace App\Http\Controllers;

use App\Models\BookingHall;
use App\Models\CancelledBookingHall;
use App\Models\Feature;
use App\Models\Hall;
use App\Models\HallPrice;
use App\Models\Studio;
use App\Models\StudioStaff;
use App\Models\User;
use App\Traits\PhoneNormalizerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Services\GeocodingService;

class StudioController extends Controller
{

    use PhoneNormalizerTrait;

    protected $geocodingService;

    public function __construct(GeocodingService $geocodingService)
    {
        $this->geocodingService = $geocodingService;
    }

    public function update_studio(Request $request)
    {
        $studio = Studio::find($request->id_studio);

        $validated = $request->validate([
            'studio_name' => 'required|min:3',
            'studio_description' => 'required',
            'studio_photo' => 'nullable|image|max:2048',
            'email_studio' => 'required|email|unique:studios,email_studio,' . $studio->id,
            'phone_studio' => 'required|unique:studios,phone_studio,' . $studio->id,
            'adress_studio' => 'required',
        ], [
            'studio_name.required' => 'Введите название студии.',
            'studio_name.min' => 'Минимальная длина названии студии - 3 символа.',
            'studio_description.required' => 'Введите название студии.',
            'studio_photo.image' => 'Выберите изображение.',
            'studio_photo.max' => 'Максимальный размер изображения не должен превышать :max KB.',
            'email_studio.required' => 'Введите адрес студии',
            'email_studio.email' => 'Введите корректный адрес электронной почты.',
            'email_studio.unique' => 'Студия с такой почтой уже существует.',
            'phone_studio.required' => 'Введите номер телефона студии.',
            'phone_studio.unique' => 'Этот номер уже занят',
            'adress_studio.required' => 'Введите адрес студии',
        ]);

        if ($request->file('studio_photo') != null) {
            $hashPhoto = $request->file('studio_photo')->hashName();
            $storePhoto = $request->file('studio_photo')->store('public/photo_studios');

            Storage::delete('public/photo_studios/' . $studio->photo_studio);
        } else {
            $hashPhoto = $studio->photo_studio;
        }

        $studio->fill([
            'name_studio' => $request->studio_name,
            'description_studio' => $request->studio_description,
            'photo_studio' => $hashPhoto,
            'email_studio' => $request->email_studio,
            'phone_studio' => $this->normalizePhoneNumber($request->phone_studio),
            'adress_studio' => $request->adress_studio,
        ]);

        if ($studio) {
            $studio->save();
            return redirect()->back()->with('success', 'Данные изменены.');
        } else {
            return redirect()->back()->with('error', 'Ошибка изменения.');
        }

    }

    public function studios_view()
    {
        $all_Studios = Studio::all();

        return view('studios', ['Studios' => $all_Studios]);
    }

    public function about_studio(Studio $studio)
    {
        return view('about_studio', ['studio_info' => $studio]);
    }

    public function my_studio_view()
    {
        $halls = Hall::where('id_studio', Auth::user()->studio->id)->get();
        return view('my_studio', ['halls' => $halls]);
    }

    public function my_hall_view(Hall $hall)
    {
        $booking = BookingHall::where('id_hall', $hall->id)->with('user', 'unregister_user')->get();

        foreach ($booking as $b) {
            if ($b->user) {
                $b->user->url = route('user.index', ['user' => $b->user->id]);
            } elseif ($b->unregisteredUser) {
                $b->warning = 'Этот пользователь не зарегистрирован на сайте.';
            }
        }

        $hall_price = HallPrice::where('id_hall', $hall->id)->get();
        $feature = Feature::all();

        return view('my_hall', ['hall' => $hall, 'bookings' => $booking, 'hall_price' => $hall_price, 'allFeatures' => $feature]);
    }

    public function getCoordinates(Request $request)
    {
        $address = $request->input('address');
        $cacheKey = 'geocode_' . md5($address);

        if (Cache::has($cacheKey)) {
            $coordinatesArray = Cache::get($cacheKey);
        } else {
            $coordinatesArray = $this->geocodingService->getCoordinates($address);
            if ($coordinatesArray) {
                $this->geocodingService->cacheCoordinates($cacheKey, $coordinatesArray);
            } else {
                return response()->json(['error' => 'Coordinates not found'], 404);
            }
        }

        return response()->json(['coordinates' => $coordinatesArray]);
    }

    public function update_banner(Request $request)
    {
        $owner = Auth::user()->studio;

        if ($request->file('banner_studio') != null) {
            if ($owner->banner_studio != 'default_studio_banner.png') {
                Storage::delete('public/banner_studio/' . $owner->banner_studio);
            }
            $hashBanner = $request->file('banner_studio')->hashName();
            $request->file('banner_studio')->store('public/banner_studio');

            $owner->banner_studio = $hashBanner;
            if ($owner->save()) {
                return redirect()->back()->with('success', 'Баннер успешно обновлен!');
            } else {
                return redirect()->back()->with('error', 'Ошибка обновления!');
            }
        } else {
            return redirect()->back()->with('error', 'Выберите фото!');
        }
    }

    public function cancelledBookings()
    {

        $cancelled = CancelledBookingHall::with('user', 'hall', 'unregisteredUser')
            ->orderBy('created_at', 'desc')
            ->where(function ($query) {
                $query->whereNotNull('id_user')
                    ->orWhereNotNull('id_unregistered_user');
            })
            ->get();

        return view('cancelledBooking', ['cancelled' => $cancelled]);
    }

    public function bookings_list()
    {
        $user = Auth::user();

        if ($user->studio) {
            $halls = Hall::where('id_studio', $user->studio->id)->get();
        } elseif ($user->staff) {
            $halls = Hall::where('id_studio', $user->staff->studio_id)->get();
        }

        return view('bookings_list', ['halls' => $halls]);
    }

    public function bookings_get(Hall $hall)
    {

        $booking = BookingHall::where('id_hall', $hall->id)->with('user', 'unregister_user')->get();

        foreach ($booking as $b) {
            if ($b->user) {
                $b->user->url = route('user.index', ['user' => $b->user->id]);
            } elseif ($b->unregisteredUser) {
                $b->warning = 'Этот пользователь не зарегистрирован на сайте.';
            }
        }

        $hall_price = HallPrice::where('id_hall', $hall->id)->get();

        return response()->json([
            'success' => true,
            'bookings' => $booking,
            'hall' => $hall,
            'hall_price' => $hall_price,
        ]);

    }

    public function list_employee()
    {
        $listEmployees = StudioStaff::where('studio_id', Auth::user()->studio->id)->paginate(10);
        return view('list-employee', ['employees' => $listEmployees]);
    }

    public function search_users(Request $request)
    {
        $query = $request->input('query');

        $staffUserIds = StudioStaff::pluck('user_id')->toArray();

        $users = User::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->orWhere('phone', 'LIKE', "%{$this->normalizePhoneNumber($query)}%");
        })
            ->whereNotIn('id', $staffUserIds) // Исключаем сотрудников
            ->whereNotIn('id_role', ['3', '2']) // Исключаем владельца студии и администратора
            ->limit(10)
            ->get(['id', 'name', 'email', 'phone']); // Выбираем только нужные поля

        return response()->json($users);
    }

    public function add_studio_staff(Request $request)
    {
        $user = Auth::user();
        $employee = User::find($request->user_id);

        if (!$user->studio) {
            return redirect()->back()->with('error', 'У вас нет доступа к этой студии!');
        }

        if (!$employee) {
            return redirect()->back()->with('error', 'Пользователь не найден.');
        }

        if ($employee->id_role == 4) {
            return redirect()->back()->with('error', 'Этот пользователь уже сотрудник студии!');
        }

        StudioStaff::create([
            'user_id' => $employee->id,
            'studio_id' => $user->studio->id,
        ]);

        $employee->id_role = 4;
        $employee->save();

        return redirect()->back()->with('success', 'Сотрудник добавлен!');

    }

    public function remove_studio_staff(Request $request)
    {

        if (!$request->user_id || !$employee = User::find($request->user_id)) {
            return response()->json(['success' => false, 'message' => 'Сотрудник не найден.']);
        }

        $staff = StudioStaff::where('user_id', $employee->id)->first();
        if ($staff) {
            $staff->delete();

            $employee->id_role = 1;
            $employee->save();

            return response()->json(['success' => true, 'message' => 'Сотрудник успешно удалён!']);
        }

        return response()->json(['success' => false, 'message' => 'Пользователь не является сотрудником.']);
    }
}
