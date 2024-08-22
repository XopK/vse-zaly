<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Studio;
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
            return redirect()->back()->with('success_studio', 'Данные изменены.');
        } else {
            return redirect()->back()->with('error_studio', 'Ошибка изменения.');
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
        return view('my_hall', ['hall' => $hall]);
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
}
