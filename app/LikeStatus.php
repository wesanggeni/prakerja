<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeStatus extends Model {
  protected $table = 'like_status';

  protected $appends = [
    'thumbUpStatus',
  ];

  protected $fillable = [
    'user_id',
    'status',
    'like_status',
  ];

  public function user(){
    return $this->belongsTo('App\User', 'user_id', 'id');
  }

  public function getThumbUpStatusAttribute(){
    return $this->user()->count();
  }
}
