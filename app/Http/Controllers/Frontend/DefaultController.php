<?php
namespace App\Http\Controllers\Frontend;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller,Sentinel;
use App\User;
use App\Circle;
use App\Status;
use App\Comment;
use App\CommentReply;
use App\LikeStatus;
use App\LikeComment;
use App\LikeCommentReply;
use Illuminate\Support\Facades\Input,Validator,Auth;
//--

class DefaultController extends Controller {

  public function lab() {
    $avatar = Avatar::create('Setan Alasss')->toBase64();
    echo '<img src="'.$avatar.'">';
  }

  public function index() {
    if ($user = Sentinel::check()) {
      
      $userId = $user->id;
      $data = Status::whereHas('circle', function($queryOne) use($userId) {
        $queryOne->where('user_id', '=', $userId);
      })
      ->orWhere('user_id', '=', $userId)
      ->with(['user' => function($queryTwo) {
        $queryTwo->select('id', 'name', 'avatar_sm');
      }])
      ->with(['comment.user' => function($queryThree) {
        $queryThree->select('id', 'name', 'avatar_sm');
      }])
      ->with('comment', 'comment.commentReply')
      ->with(['comment.commentReply.user' => function($queryFour) {
        $queryFour->select('id', 'name', 'avatar_sm');
      }])
      ->paginate(15);

      $circleRecom = User::get();

      return view('frontend/home', ['data' => $data, 'circleRecom' => $circleRecom]);
    } else {
      return view('frontend/home-default');
    }
    
  }

  public function job() {
    return view('frontend/job');
  }

  public function member() {
    return view('frontend/login');
  }

  public function login() {
    return view('frontend/login');
  }

  public function register() {
    return view('frontend/register');
  }


}