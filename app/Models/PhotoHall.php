<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PhotoHall extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_hall',
        'photo_hall',
    ];

    protected static function booted()
    {
        static::deleting(function ($photo) {
            if ($photo->photo_hall && Storage::disk('public')->exists($photo->photo_hall)) {
                Storage::disk('public')->delete($photo->photo_hall);
            }
        });
    }

    public function halls()
    {
        return $this->belongsTo(Hall::class, 'id_hall');
    }
}
