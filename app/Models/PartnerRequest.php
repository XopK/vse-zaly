<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerRequest extends Model
{

    protected $fillable = [
        'email',
        'name',
        'name_studio',
        'address',
        'phone',
        'password',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
