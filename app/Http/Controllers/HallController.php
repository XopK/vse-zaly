<?php

namespace App\Http\Controllers;

use App\Models\BookingHall;
use App\Models\Hall;
use App\Models\HallOption;
use App\Models\PhotoHall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HallController extends Controller
{
    public function my_halls()
    {
        $halls = Hall::where('id_studio', Auth::user()->studio->id)->get();

        return view('my_halls', ['halls' => $halls]);
    }

    public function hall_view(Hall $hall)
    {
        $booking = BookingHall::where('id_hall', $hall->id)->get();
        return view('hall', ['hall' => $hall, 'bookings' => $booking]);
    }

    public function create_halls(Request $request)
    {
        $validated = $request->validate([
            'name_hall' => 'required',
            'area_hall' => 'required|integer',
            'description_hall' => 'required',
            'location_hall' => 'required',
            'terms_hall' => 'required',
            'step_booking' => 'required|numeric'
        ], [
            'name_hall.required' => 'Введите название студии.',
            'area_hall.integer' => 'Введите числовые значения.',
            'area_hall.required' => 'Введите площадь зала.',
            'description_hall.required' => 'Введите описание зала.',
            'photo_hall.*.required' => 'Выберите фото.',
            'photo_hall.*.image' => 'Только изображения!',
            'photo_hall.*.max' => 'Максимальный размер изображения не должен превышать :max KB.',
            'location_hall.required' => 'Введите адрес.',
            'terms_hall.required' => 'Напишите паравила.',
            'step_booking.integer' => 'Введите числовые значения.',
            'step_booking.required' => 'Выберите шаг.',
        ]);

        $studio = Auth::user()->studio;

        $hashFirst = $request->file('photo_hall')[0]->hashName();
        $storeFirst = $request->file('photo_hall')[0]->store('public/photo_halls');

        $hall = Hall::create([
            'name_hall' => $request->name_hall,
            'description_hall' => $request->description_hall,
            'area_hall' => $request->area_hall,
            'address_hall' => $request->location_hall,
            'rule_hall' => $request->terms_hall,
            'id_studio' => $studio->id,
            'preview_hall' => $hashFirst,
            'step_booking' => $request->step_booking,
        ]);

        PhotoHall::create([
            'id_hall' => $hall->id,
            'photo_hall' => $hashFirst,
        ]);

        foreach (array_slice($request->file('photo_hall'), 1) as $item) {
            $hashPhoto = $item->hashName();
            $storePhoto = $item->store('public/photo_halls');

            $photoHalls = PhotoHall::create([
                'id_hall' => $hall->id,
                'photo_hall' => $hashPhoto,
            ]);
        }


        if ($hall) {
            return redirect()->back()->with('success_create', 'Зал успешно создан!');
        } else {
            return redirect()->back()->with('error_create', 'Ошибка создания.');
        }

    }

    public function edit_hall(Request $request, Hall $hall)
    {
        $validated = $request->validate([
            'hall_name' => 'required',
            'hall_area' => 'required|integer',
            'hall_description' => 'required',
            'hall_terms' => 'required',
            'step_booking' => 'required|numeric',
        ], [
            'hall_name.required' => 'Введите название зала.',
            'hall_area.required' => 'Введите площадь зала.',
            'hall_area.integer' => 'Введите числовые значения.',
            'hall_description.required' => 'Введите описание зала.',
            'hall_terms.required' => 'Введите правила зала.',
            'step_booking.required' => 'Введите шаг бронирования.',
            'step_booking.integer' => 'Введите числовые значения.',
        ]);

        $hall->fill([
            'name_hall' => $request->hall_name,
            'description_hall' => $request->hall_description,
            'area_hall' => $request->hall_area,
            'rule_hall' => $request->hall_terms,
            'step_booking' => $request->step_booking,
        ]);

        if ($hall) {
            $hall->save();
            return redirect()->back()->with('success_hall', 'Зал обновлен!');
        } else {
            return redirect()->back()->with('error_hall', 'Ошибка обновления!');
        }
    }

    public function delete_photo($photo)
    {
        $delete = PhotoHall::find($photo);
        $hall = $delete->halls;


        if ($delete) {
            if ($delete->photo_hall == $hall->preview_hall) {
                return response()->json(['success' => false], 404);
            } else {
                Storage::delete('public/photo_halls/' . $delete->photo_hall);
                $delete->delete();
                return response()->json(['success' => true]);
            }
        } else {
            return response()->json(['success' => false], 404);
        }

    }

    public function update_preview($photo)
    {
        $newPhoto = PhotoHall::find($photo);
        $hall = $newPhoto->halls;

        if ($newPhoto) {
            $hall->fill([
                'preview_hall' => $newPhoto->photo_hall,
            ]);
            $hall->save();
            return response()->json(['success' => true]);

        } else {
            return response()->json(['success' => false], 404);
        }

    }

    public function addPhoto(Request $request, $hall)
    {
        $request->validate([
            'photo_hall' => 'required'
        ], [
            'photo_hall.required' => 'Выберите хотя бы одно фото.'
        ]);

        foreach ($request->photo_hall as $photo) {
            $hashPhoto = $photo->hashName();
            $storePhoto = $photo->store('public/photo_halls');

            $check = PhotoHall::create([
                'id_hall' => $hall,
                'photo_hall' => $hashPhoto,
            ]);
        }

        if ($check) {
            return redirect()->back()->with('success_hall', 'Фото добавлено!');
        } else {
            return redirect()->back()->with('error_hall', 'Ошибка добавления');
        }

    }

    public function all_halls()
    {
        $halls = Hall::all();

        return view('filter', ['halls' => $halls]);
    }
}
