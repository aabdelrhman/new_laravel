<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory , Notifiable;

    protected $fillable = ['name' , 'email' , 'password' , 'google_id' ,'is_email_verified'];


    protected $hidden = ['password' , 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
