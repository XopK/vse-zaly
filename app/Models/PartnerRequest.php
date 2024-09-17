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
    ];
}
