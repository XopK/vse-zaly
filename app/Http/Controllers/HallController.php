<?php

namespace App\Http\Controllers;

use App\Models\BookingHall;
use App\Models\Feature;
use App\Models\FeatureHalls;
use App\Models\Hall;
use App\Models\HallPrice;
use App\Models\PhotoHall;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HallController extends Controller
{
    public function my_halls()
    {
        $halls = Hall::where('id_studio', Auth::user()->studio->id)->get();
        $features = Feature::all();

        return view('my_halls', ['halls' => $halls, 'features' => $features]);
    }

    public function hall_view(Hall $hall)
    {
        $booking = BookingHall::where('id_hall', $hall->id)->whereNotNull('payment_id')->get();
        $hallPrice = HallPrice::where('id_hall', $hall->id)->get();

        $sessionKey = 'hall_view_' . $hall->id;

        if (!session()->has($sessionKey)) {
            $hall->increment('view_count');
            session([$sessionKey => true]);
        }

        $isFavorite = false;
        if (Auth::check()) {
            $user = Auth::user();
            $isFavorite = $user->favorites()->where('id_hall', $hall->id)->exists();
        }

        return view('hall', ['hall' => $hall, 'bookings' => $booking, 'isFavorite' => $isFavorite, 'hallPrice' => $hallPrice]);
    }

    public function create_halls(Request $request)
    {
        $validated = $request->validate([
            'name_hall' => 'required',
            'area_hall' => 'required|integer',
            'description_hall' => 'required',
            'location_hall' => 'required',
            'terms_hall' => 'required',
            'step_booking' => 'required|numeric',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'max_people.*' => 'required|numeric|min:1',
            'min_people.*' => 'required|numeric|min:1',
            'weekday_price.*' => 'required|numeric|min:0',
            'weekday_evening_price.*' => 'required|numeric|min:0',
            'weekend_price.*' => 'required|numeric|min:0',
            'weekend_evening_price.*' => 'required|numeric|min:0',
        ], [
            'name_hall.required' => 'Введите название студии.',
            'area_hall.integer' => 'Введите числовые значения.',
            'area_hall.required' => 'Введите площадь зала.',
            'description_hall.required' => 'Введите описание зала.',
            'location_hall.required' => 'Введите адрес.',
            'terms_hall.required' => 'Напишите паравила.',
            'step_booking.integer' => 'Введите числовые значения.',
            'step_booking.required' => 'Выберите шаг.',
            'start_time.required' => 'Введите время начало работы зала.',
            'start_time.date_format' => 'Введите верный формат времени.',
            'end_time.required' => 'Введите время закрытия зала.',
            'end_time.date_format' => 'Введите верный формат времени.',
            'max_people.*.required' => 'Укажите максимальное количество людей.',
            'max_people.*.numeric' => 'Максимальное количество людей должно быть числом.',
            'max_people.*.min' => 'Максимальное количество людей должно быть не менее 1.',
            'min_people.*.required' => 'Укажите минимальное количество людей.',
            'min_people.*.numeric' => 'Минимальное количество людей должно быть числом.',
            'min_people.*.min' => 'Минимальное количество людей должно быть не менее 1.',
            'weekday_price.*.required' => 'Укажите цену на будний день.',
            'weekday_price.*.numeric' => 'Цена на будний день должна быть числом.',
            'weekday_price.*.min' => 'Цена на будний день не может быть отрицательной.',
            'weekday_evening_price.*.required' => 'Укажите вечернюю цену на будний день.',
            'weekday_evening_price.*.numeric' => 'Вечерняя цена на будний день должна быть числом.',
            'weekday_evening_price.*.min' => 'Вечерняя цена на будний день не может быть отрицательной.',
            'weekend_price.*.required' => 'Укажите цену на выходной день.',
            'weekend_price.*.numeric' => 'Цена на выходной день должна быть числом.',
            'weekend_price.*.min' => 'Цена на выходной день не может быть отрицательной.',
            'weekend_evening_price.*.required' => 'Укажите вечернюю цену на выходной день.',
            'weekend_evening_price.*.numeric' => 'Вечерняя цена на выходной день должна быть числом.',
            'weekend_evening_price.*.min' => 'Вечерняя цена на выходной день не может быть отрицательной.',
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
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        foreach ($request->features as $feature) {
            FeatureHalls::create([
                'id_feature' => $feature,
                'id_hall' => $hall->id,
            ]);
        }

        foreach ($request->min_people as $index => $min_people) {
            $hall_price = HallPrice::create([
                'id_hall' => $hall->id,
                'min_people' => $min_people,
                'max_people' => $request->max_people[$index],
                'weekday_price' => $request->weekday_price[$index],
                'weekday_evening_price' => $request->weekday_evening_price[$index],
                'weekend_price' => $request->weekend_price[$index],
                'weekend_evening_price' => $request->weekend_evening_price[$index]
            ]);
        }

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
            'address_hall' => 'required',
            'hall_description' => 'required',
            'hall_terms' => 'required',
            'step_booking' => 'required|numeric',
            'start_time' => 'required',
            'end_time' => 'required',
            'max_people.*' => 'required|numeric|min:1',
            'min_people.*' => 'required|numeric|min:1',
            'weekday_price.*' => 'required|numeric|min:0',
            'weekday_evening_price.*' => 'required|numeric|min:0',
            'weekend_price.*' => 'required|numeric|min:0',
            'weekend_evening_price.*' => 'required|numeric|min:0',
        ], [
            'hall_name.required' => 'Введите название зала.',
            'hall_area.required' => 'Введите площадь зала.',
            'hall_area.integer' => 'Введите числовые значения.',
            'hall_description.required' => 'Введите описание зала.',
            'hall_terms.required' => 'Введите правила зала.',
            'step_booking.required' => 'Введите шаг бронирования.',
            'step_booking.integer' => 'Введите числовые значения.',
            'start_time.required' => 'Введите время начало работы зала.',
            'start_time.date_format' => 'Введите верный формат времени.',
            'end_time.required' => 'Введите время закрытия зала.',
            'end_time.date_format' => 'Введите верный формат времени.',
            'max_people.*.required' => 'Укажите максимальное количество людей.',
            'max_people.*.numeric' => 'Максимальное количество людей должно быть числом.',
            'max_people.*.min' => 'Максимальное количество людей должно быть не менее 1.',
            'min_people.*.required' => 'Укажите минимальное количество людей.',
            'min_people.*.numeric' => 'Минимальное количество людей должно быть числом.',
            'min_people.*.min' => 'Минимальное количество людей должно быть не менее 1.',
            'weekday_price.*.required' => 'Укажите цену на будний день.',
            'weekday_price.*.numeric' => 'Цена на будний день должна быть числом.',
            'weekday_price.*.min' => 'Цена на будний день не может быть отрицательной.',
            'weekday_evening_price.*.required' => 'Укажите вечернюю цену на будний день.',
            'weekday_evening_price.*.numeric' => 'Вечерняя цена на будний день должна быть числом.',
            'weekday_evening_price.*.min' => 'Вечерняя цена на будний день не может быть отрицательной.',
            'weekend_price.*.required' => 'Укажите цену на выходной день.',
            'weekend_price.*.numeric' => 'Цена на выходной день должна быть числом.',
            'weekend_price.*.min' => 'Цена на выходной день не может быть отрицательной.',
            'weekend_evening_price.*.required' => 'Укажите вечернюю цену на выходной день.',
            'weekend_evening_price.*.numeric' => 'Вечерняя цена на выходной день должна быть числом.',
            'weekend_evening_price.*.min' => 'Вечерняя цена на выходной день не может быть отрицательной.',
        ]);

        $hall->fill([
            'name_hall' => $request->hall_name,
            'address_hall' => $request->address_hall,
            'description_hall' => $request->hall_description,
            'area_hall' => $request->hall_area,
            'rule_hall' => $request->hall_terms,
            'step_booking' => $request->step_booking,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        $features = $request->input('features', []);

        $hall->features()->sync($features);

        foreach ($request->min_people as $index => $min_people) {

            if (isset($request->id_price[$index])) {

                $prices = HallPrice::where('id', $request->id_price[$index])->first();

                if ($prices != null) {
                    $prices->fill([
                        'min_people' => $min_people,
                        'max_people' => $request->max_people[$index],
                        'weekday_price' => $request->weekday_price[$index],
                        'weekday_evening_price' => $request->weekday_evening_price[$index],
                        'weekend_price' => $request->weekend_price[$index],
                        'weekend_evening_price' => $request->weekend_evening_price[$index],
                    ]);
                    $prices->save();
                }
            } else {
                HallPrice::create([
                    'id_hall' => $hall->id,
                    'min_people' => $request->min_people[$index],
                    'max_people' => $request->max_people[$index],
                    'weekday_price' => $request->weekday_price[$index],
                    'weekday_evening_price' => $request->weekday_evening_price[$index],
                    'weekend_price' => $request->weekend_price[$index],
                    'weekend_evening_price' => $request->weekend_evening_price[$index],
                ]);
            }
        }

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
        $halls = Hall::paginate(12);
        $studios = Studio::all();

        return view('filter', ['halls' => $halls, 'studios' => $studios]);
    }

    public function filter_halls(Request $request)
    {
        $query = Hall::query();

        if ($request->filled('search')) {
            $search = strtolower($request->input('search'));
            $query->whereRaw("LOWER(name_hall) LIKE ?", ["%$search%"])
                ->orWhereRaw("LOWER(address_hall) LIKE ?", ["%$search%"]);
        }

        if ($request->has('date') && $request->date != '' && $request->has('time') && $request->time != '') {
            $selectedDate = $request->date;
            $selectedTime = $request->time;

            $query->whereDoesntHave('booking_halls', function ($bookingQuery) use ($selectedDate, $selectedTime) {
                $bookingQuery->whereDate('booking_start', $selectedDate)
                    ->whereTime('booking_start', '<=', $selectedTime)
                    ->whereTime('booking_end', '>=', $selectedTime);
            });
        }

        if ($request->filled('price')) {
            $price = $request->input('price');

            // Фильтруем залы по максимальной цене в связанных записях
            $query->whereHas('hall_price', function ($subQuery) use ($price) {
                $subQuery->whereRaw('GREATEST(weekday_price, weekday_evening_price, weekend_price, weekend_evening_price) >= ?', [$price]);
            });
        }


        if ($request->filled('area')) {
            $query->where('area_hall', '<=', $request->input('area'));
        }

        if ($request->filled('studio')) {
            $query->whereHas('studio', function ($q) use ($request) {
                $q->where('id_studio', $request->input('studio'));
            });
        }

        if ($request->filled('sort')) {
            switch ($request->input('sort')) {
                case '#asc':
                    // Сортировка по возрастанию максимальной цены
                    $query->leftJoin('hall_prices', 'halls.id', '=', 'hall_prices.id_hall')
                        ->select('halls.*', DB::raw('GREATEST(MAX(weekday_price), MAX(weekday_evening_price), MAX(weekend_price), MAX(weekend_evening_price)) as max_price'))
                        ->groupBy('halls.id') // Группируем по ID залов, чтобы избежать дублирования
                        ->orderBy('max_price', 'asc');
                    break;
                case '#desc':
                    // Сортировка по убыванию максимальной цены
                    $query->leftJoin('hall_prices', 'halls.id', '=', 'hall_prices.id_hall')
                        ->select('halls.*', DB::raw('GREATEST(MAX(weekday_price), MAX(weekday_evening_price), MAX(weekend_price), MAX(weekend_evening_price)) as max_price'))
                        ->groupBy('halls.id') // Группируем по ID залов, чтобы избежать дублирования
                        ->orderBy('max_price', 'desc');
                    break;
                case '#all':
                    // Нет сортировки
                    break;
            }
        }

        $halls = $query->paginate(12);

        $html = view('partials.halls', compact('halls'))->render();
        $pagination = $halls->links()->render();

        return response()->json(['html' => $html, 'pagination' => $pagination]);
    }

    public function delete_hall(Hall $hall)
    {
        $user = Auth::user();

        $isOwner = Hall::where('id_studio', $user->studio->id)->where('id', $hall->id)->exists();
        if ($isOwner) {
            $hall->delete();
            return redirect()->back()->with('success', 'Зал удален!');
        }

        return redirect()->back()->with('error', 'Ошибка удаления');

    }

    public function delete_price($id)
    {
        $price = HallPrice::findOrFail($id);
        $price->delete();

        return response()->json(['success' => 'Запись удалена успешно']);
    }


}
