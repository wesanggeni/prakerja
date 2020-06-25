<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller,Sentinel;
use Illuminate\Database\Eloquent\Model;

class Status extends Model {
  protected $table = 'status';

  protected $appends = [
    'comment_count',
    'thumb_up_count',
    'thumb_down_count',
    'thumb_up_status',
    'thumb_down_status',
  ];

  protected $hidden = [
    'updated_at',
  ];

  protected $fillable = [
    'user_id',
    'status',
  ];

  //baris pertama milik relasi, kedua milik tabel disini
  public function circle(){
    return $this->belongsTo('App\Circle', 'user_id', 'circle');
  }

  public function user(){
    return $this->belongsTo('App\User', 'user_id', 'id');
  }

  public function comment(){
    return $this->hasMany('App\Comment', 'status', 'id');
  }

  /* like attribute */
  public function likeStatus(){
    return $this->hasMany('App\LikeStatus', 'status', 'id');
  }

  public function thumbUp() {
      return $this->likeStatus()->where('like_status','=', 1);
  }

  public function thumbDown() {
      return $this->likeStatus()->where('like_status','=', 2);
  }

  public function thumbUpStatus() {
    $userId = null;
    if (Auth::check()) {
      $user = Auth::user();
      $userId = $user->id;
    } elseif ($user = Sentinel::check()) {
      $userId = $user->id;
    }
      return $this->likeStatus()->where('user_id','=', $userId)
      ->where('like_status','=', 1);
  }

  public function thumbDownStatus() {
    $userId = null;
    if (Auth::check()) {
      $user = Auth::user();
      $userId = $user->id;
    } elseif ($user = Sentinel::check()) {
      $userId = $user->id;
    }
      return $this->likeStatus()->where('user_id','=', $userId)
      ->where('like_status','=', 2);
  }

  public function getCommentCountAttribute(){
    return $this->comment()->count();
  }

  public function getThumbUpCountAttribute(){
    return $this->thumbUp()->count();
  }

  public function getThumbDownCountAttribute(){
    return $this->thumbDown()->count();
  }

  public function getThumbUpStatusAttribute(){
    return $this->thumbUpStatus()->count();
  }

  public function getThumbDownStatusAttribute(){
    return $this->thumbDownStatus()->count();
  }
}
