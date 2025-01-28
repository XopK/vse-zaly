<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class VideoHall extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_hall',
        'video',
    ];

    protected static function booted()
    {
        static::deleting(function ($video) {
            if ($video->video && Storage::disk('public')->exists('video_halls/' . $video->video)) {
                Storage::disk('public')->delete('video_halls/' . $video->video);
            }
        });
    }

    public function halls()
    {
        return $this->belongsTo(Hall::class, 'id_hall');
    }
}
