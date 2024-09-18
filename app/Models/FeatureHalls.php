<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureHalls extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_feature',
        'id_hall',
    ];

    public $timestamps = false;

    public function halls()
    {
        return $this->belongsTo(Hall::class, 'id_hall');
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class, 'id_feature');
    }
}
