<?php

namespace App;

use App\Http\Controllers\Controller,Sentinel;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
  protected $table = 'comment';

  protected $appends = [
    'comment_reply_count',
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
    'comment',
  ];

  public function commentReply(){
    return $this->hasMany('App\CommentReply', 'comment', 'id');
  }

  public function user(){
    return $this->belongsTo('App\User', 'user_id', 'id');
  }

  /* like attribute */
  public function likeComment(){
    return $this->hasMany('App\LikeComment', 'comment', 'id');
  }

  public function thumbUp() {
      return $this->likeComment()->where('like_status','=', 1);
  }

  public function thumbDown() {
      return $this->likeComment()->where('like_status','=', 2);
  }

  public function thumbUpStatus() {
  	$user = Sentinel::check();
      return $this->likeComment()->where('user_id','=', $user->id)
      ->where('like_status','=', 1);
  }

  public function thumbDownStatus() {
  	$user = Sentinel::check();
      return $this->likeComment()->where('user_id','=', $user->id)
      ->where('like_status','=', 2);
  }

  public function getCommentReplyCountAttribute(){
    return $this->commentReply()->count();
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
