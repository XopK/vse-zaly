<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHall extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_hall',
        'id_user',
        'booking_start',
        'booking_end',
        'total_price',
        'status_booking',
        'count_people_booking',
    ];
}
