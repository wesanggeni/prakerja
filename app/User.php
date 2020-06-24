<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, Notifiable;

  protected $fillable = [
    'email', 'password', 'first_name', 'last_name', 'avatar',
  ];

  protected $hidden = [
    'id', 'email', 'permissions', 'password', 'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

}
