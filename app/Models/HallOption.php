<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'coffee_hall',
        'bar_hall',
        'wifi_hall',
        'id_hall',
        'tv_hall',
        'lamp_hall',
    ];
}
