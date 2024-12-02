<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_hall',
        'min_people',
        'max_people',
        'weekday_price',
        'weekday_evening_price',
        'weekend_price',
        'weekend_evening_price',
        'color'
    ];

    public function hall()
    {
        return $this->belongsTo(Hall::class, 'id_hall');
    }
}
