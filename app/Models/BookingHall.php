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
        'payment_id',
        'is_archive',
        'min_people',
        'max_people',
        'id_unregistered_user',
        'is_available',
        'link_payment',
        'reason_close'
    ];

    protected $dates = ['booking_start', 'booking_end'];

    protected static function booted()
    {
        static::updated(function ($booking) {
            if ($booking->isDirty('payment_id')) {
                $booking->hall->increment('count_booking');
            }
        });

        static::deleted(function ($booking) {
            if (!$booking->disableEvents) {
                $booking->hall->decrement('count_booking');
            }
        });
    }

    public function income($money)
    {
        $hall = $this->hall;
        $hall->total_income += $money;
        $hall->save();
    }

    public function minusincome($money)
    {
        $hall = $this->hall;
        $hall->total_income -= $money;
        $hall->save();
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class, 'id_hall');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function is_expired()
    {
        if ($this->booking_end instanceof \Carbon\Carbon) {
            return $this->booking_end->isPast();
        } else {
            $bookingEnd = \Carbon\Carbon::parse($this->booking_end);
            return $bookingEnd->isPast();
        }
    }

    public function update_booking()
    {
        if ($this->is_expired() && $this->is_archive == 0) {
            $this->is_archive = 1;
            $this->save();
        }
    }

    public function unregister_user()
    {
        return $this->belongsTo(UnregisteredUser::class, 'id_unregistered_user');
    }
}
