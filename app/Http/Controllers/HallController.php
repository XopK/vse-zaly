<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\HallOption;
use App\Models\PhotoHall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HallController extends Controller
{
    public function my_halls()
    {
        $halls = Hall::where('id_studio', Auth::user()->studio->id)->get();

        return view('my_halls', ['halls' => $halls]);
    }

    public function create_halls(Request $request)
    {
        $validated = $request->validate([
            'name_hall' => 'required',
            'area_hall' => 'required|integer',
            'description_hall' => 'required',
            'photo_hall.*' => 'required|image|max:2048',
        ], [
            'name_hall.required' => 'Введите название студии.',
            'area_hall.integer' => 'Введите числовые значения.',
            'area_hall.required' => 'Введите площадь зала.',
            'description_hall.required' => 'Введите описание зала.',
            'photo_hall.*.required' => 'Выберите фото.',
            'photo_hall.*.image' => 'Только изображения!',
            'photo_hall.*.max' => 'Максимальный размер изображения не должен превышать :max KB.',
        ]);

        $studio = Auth::user()->studio;

        $hashFirst = $request->file('photo_hall')[0]->hashName();
        $storeFirst = $request->file('photo_hall')[0]->store('public/photo_halls');

        $hall = Hall::create([
            'name_hall' => $request->name_hall,
            'description_hall' => $request->description_hall,
            'area_hall' => $request->area_hall,
            'id_studio' => $studio->id,
            'preview_hall' => $hashFirst,
        ]);

        foreach (array_slice($request->file('photo_hall'), 1) as $item) {
            $hashPhoto = $item->hashName();
            $storePhoto = $item->store('public/photo_halls');

            $photoHalls = PhotoHall::create([
                'id_hall' => $hall->id,
                'photo_hall' => $hashPhoto,
            ]);
        }

        HallOption::create([
            'id_hall' => $hall->id,
            'coffee_hall' => $request->has('coffee_hall'),
            'bar_hall' => $request->has('bar_hall'),
            'wifi_hall' => $request->has('wifi_hall'),
            'tv_hall' => $request->has('tv_hall'),
            'lamp_hall' => $request->has('lamp_hall'),
        ]);


        if ($hall) {
            return redirect()->back()->with('success_create', 'Зал успешно создан!');
        } else {
            return redirect()->back()->with('error_create', 'Ошибка создания.');
        }

    }
}
