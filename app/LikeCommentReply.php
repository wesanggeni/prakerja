<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeCommentReply extends Model {
  protected $table = 'like_comment_reply';

  protected $fillable = [
    'user_id',
    'comment_reply',
    'like_status',
  ];
}
