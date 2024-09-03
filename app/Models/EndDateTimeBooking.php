<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndDateTimeBooking extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_booking',
        'booking_start',
        'booking_end',
    ];
}
