<?php

namespace App\Models;

use App\View\Components\booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnregisteredUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
    ];

    public function bookings()
    {
        return $this->hasMany(BookingHall::class, 'id_unregistered_user');
    }

    public function canceledBookings()
    {
        return $this->hasMany(CancelledBookingHall::class, 'id_unregistered_user');
    }
}
