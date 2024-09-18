<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_feature',
        'photo_feature',
    ];

    public function halls()
    {
        return $this->belongsToMany(Hall::class, 'feature_halls', 'id_feature', 'id_hall');
    }
}
