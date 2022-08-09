<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// above usages have been imported from User.php

class CustomerLogin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; //imported from User.php

    protected $guared = ['id']; //created by me

    protected $guard = 'logan'; //created by me

    //imported from User.php
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
