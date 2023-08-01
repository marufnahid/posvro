<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'phone',
        'otp',
        'otpVerified',
        'emailVerified',
        'phoneVerified',
        'role',
        'status',
        'profileImage',
        'address',
        'city',
        'state',
        'country',
    ];

    protected $attributes = [
        'otp' => '0',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

//    protected $casts = [
//        'password' => 'hashed'
//    ];

}
