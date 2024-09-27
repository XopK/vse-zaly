<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\View\Components\booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'photo_profile',
        'phone_verfied',
        'email',
        'telegram',
        'vk',
        'instagram',
        'password',
        'id_role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    protected $rememberTokenName = 'remember_token';


    public function studio()
    {
        return $this->hasOne(Studio::class, 'id_user');
    }

    public function booking()
    {
        return $this->hasMany(BookingHall::class, 'id_user');
    }

    public function favorites()
    {
        return $this->hasMany(FavoriteHall::class, 'id_user');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function requests()
    {
        return $this->hasOne(PartnerRequest::class, 'id_user');
    }
}
