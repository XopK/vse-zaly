<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'count_booking',
        'total_income',
        'view_count',
    ];

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
}
