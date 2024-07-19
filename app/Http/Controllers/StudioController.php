<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudioController extends Controller
{
    public function update_studio(Request $request)
    {
        $validated = $request->validate([
            'studio_name' => 'required|min:3',
            'studio_description' => 'required',
            'studio_photo' => 'image|max:2048',
        ], [
            'studio_name.required' => 'Введите название студии.',
            'studio_name.required' => 'Минимальная длина названии студии - 3 символа.',
            'studio_description.required' => 'Введите название студии.',
            'studio_photo.image' => 'Выберите изображение.',
            'studio_photo.max' => 'Максимальный размер изображения не должен превышать :max KB.',
        ]);

        $studio = Studio::find($request->id_studio);

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
}
