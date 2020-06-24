<?php

namespace App;

use App\Http\Controllers\Controller,Sentinel;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model {
  protected $table = 'comment_reply';

  protected $appends = [
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
    'comment',
    'comment_reply',
  ];

  public function user(){
    return $this->belongsTo('App\User', 'user_id', 'id');
  }

  /* like attribute */
  public function likeCommentReply(){
    return $this->hasMany('App\LikeCommentReply', 'comment_reply', 'id');
  }

  public function thumbUp() {
      return $this->likeCommentReply()->where('like_status','=', 1);
  }

  public function thumbDown() {
      return $this->likeCommentReply()->where('like_status','=', 2);
  }

  public function thumbUpStatus() {
  	$user = Sentinel::check();
      return $this->likeCommentReply()->where('user_id','=', $user->id)
      ->where('like_status','=', 1);
  }

  public function thumbDownStatus() {
  	$user = Sentinel::check();
      return $this->likeCommentReply()->where('user_id','=', $user->id)
      ->where('like_status','=', 2);
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
