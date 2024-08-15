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
        'price_weekday',
        'price_weekend',
        'time_evening',
        'price_evening',
        'max_price',
        'price_for_two',
        'price_for_four',
        'price_for_seven',
        'price_for_nine',
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
}
