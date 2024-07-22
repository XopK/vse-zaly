<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_hall',
        'description_hall',
        'area_hall',
        'id_studio',
        'preview_hall',
    ];
}
