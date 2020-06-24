<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeComment extends Model {
  protected $table = 'like_comment';

  protected $fillable = [
    'user_id',
    'comment',
    'like_status',
  ];
}
