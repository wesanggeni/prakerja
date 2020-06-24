<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circle extends Model {
  protected $table = 'circle';

  protected $fillable = [
    'status',
  ];

  public function user(){
    return $this->belongsTo('App\User', 'id', 'user_id');
  }

  public function status(){
    return $this->belongsTo('App\Status', 'user_id', 'user_id');
  }

}
