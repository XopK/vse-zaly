<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoHall extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_hall',
        'photo_hall',
    ];

    public function halls()
    {
        return $this->belongsTo(Hall::class, 'id_hall');
    }
}
