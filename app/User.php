<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, Notifiable;

  protected $fillable = [
    'name', 
    'first_name', 
    'last_name', 
    'email', 
    'password',
    'avatar_lg',
    'avatar_md',
    'avatar_sm',
  ];

  protected $hidden = [
    'id', 
    'email', 
    'permissions', 
    'password', 
    'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function getAvatarLgAttribute($value) {
    return url('/').'/'.$value;
  }

  public function getAvatarMdAttribute($value) {
    return url('/').'/'.$value;
  }

  public function getAvatarSmAttribute($value) {
    return url('/').'/'.$value;
  }
}
