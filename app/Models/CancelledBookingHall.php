<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelledBookingHall extends Model
{
    use HasFactory;

    protected $table = 'cancelled_booking_halls';

    protected $fillable = [
        'id_hall',
        'id_user',
        'booking_start',
        'booking_end',
        'total_price',
        'payment_id',
        'is_archive',
        'min_people',
        'max_people',
        'id_unregistered_user',
    ];

    public function hall()
    {
        return $this->belongsTo(Hall::class, 'id_hall');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function unregisteredUser()
    {
        return $this->belongsTo(UnregisteredUser::class, 'id_unregistered_user');
    }
}
