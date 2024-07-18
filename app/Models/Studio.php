<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_studio',
        'description_studio',
        'photo_studio',
        'id_user',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
