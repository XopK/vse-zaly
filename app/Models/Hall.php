<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_hall',
        'description_hall',
        'area_hall',
        'rule_hall',
        'address_hall',
        'id_studio',
        'preview_hall',
        'step_booking',
        'start_time',
        'end_time',
        'time_evening',
        'count_booking',
        'total_income',
        'view_count',
    ];

    protected static function booted()
    {
        static::deleting(function ($hall) {
            foreach ($hall->photo_halls as $photo) {
                if ($photo->photo_hall && Storage::disk('public')->exists($photo->photo_hall)) {
                    Storage::disk('public')->delete($photo->photo_hall);
                }
                $photo->delete();
            }
        });
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'id_studio');
    }

    public function photo_halls()
    {
        return $this->hasMany(PhotoHall::class, 'id_hall');
    }

    public function booking_halls()
    {
        return $this->hasMany(BookingHall::class, 'id_hall');
    }

    public function FavoriteHalls()
    {
        return $this->hasMany(FavoriteHall::class, 'id_hall');
    }

    public function hall_price()
    {
        return $this->hasMany(HallPrice::class, 'id_hall');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_halls', 'id_hall', 'id_feature');
    }
}
