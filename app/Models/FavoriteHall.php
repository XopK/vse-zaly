<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteHall extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_hall',
        'id_user',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function halls()
    {
        return $this->belongsTo(Hall::class, 'id_hall');
    }
}
