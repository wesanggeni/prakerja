<?php
namespace App\Http\Controllers\Api;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller,Sentinel;
use App\User;
use App\Status;
use App\Comment;
use App\CommentReply;
use App\LikeStatus;
use App\LikeComment;
use App\LikeCommentReply;
use Illuminate\Support\Facades\Input,Validator,Auth;
//--

class StatusController extends Controller {

  public function lab() {
    $user = Auth::user();
    print_r($user);
    //return view('frontend/home');
  }

  public function index() {
    $user = Auth::user();
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

      return response()->json([
        'status'    => true,
        'message'   => null,
        'data'      => $data,
      ], 200);
  }

  public function getComment(Request $request) {
    $user = Auth::user();
    $validator = Validator::make($request->all(), [
      'dataId'  => 'required',
    ]);

    $data = Comment::where('status', '=', $request->dataId)
      ->with(['user' => function($query) {
        $query->select('id', 'name', 'avatar_sm');
      }])
      ->paginate(15);

      return response()->json([
        'status'    => true,
        'message'   => null,
        'data'      => $data,
      ], 200);
  }

  public function getReply(Request $request) {
    $user = Auth::user();
    $validator = Validator::make($request->all(), [
      'dataId'  => 'required',
    ]);

    $data = CommentReply::where('comment', '=', $request->dataId)
      ->with(['user' => function($query) {
        $query->select('id', 'name', 'avatar_sm');
      }])
      ->paginate(15);

      return response()->json([
        'status'    => true,
        'message'   => null,
        'data'      => $data,
      ], 200);
  }

  public function create(Request $request) {
    $user = Auth::user();

    $validator = Validator::make($request->all(), [
      'status'  => 'required|string',
    ]);

    if ($validator->fails()) {    
      return response()->json($validator->messages(), 200);
    }

    $status = new Status;
    $status->user_id = $user->id;
    $status->status = $request->status;

    if ($status->save()) {
      $created = Status::where('id', '=', $status->id)
      ->with(['user' => function($query) {
        $query->select('id', 'name', 'avatar_sm');
      }])->first();
      return response()->json([
        'status'    => true,
        'message'   => null,
        'data'      => $created,
      ], 200);
    }
  }

  public function comment(Request $request) {
    $user = Auth::user();

    $validator = Validator::make($request->all(), [
      'dataId'  => 'required',
      'comment' => 'required',
    ]);

    if ($validator->fails()) {    
      return response()->json($validator->messages(), 200);
    }

    $comment            = new Comment;
    $comment->user_id   = $user->id;
    $comment->status    = $request->dataId;
    $comment->comment   = $request->comment;

    if ($comment->save()) {
      $created = Comment::where('id', '=', $comment->id)
      ->with(['user' => function($query) {
        $query->select('id', 'name', 'avatar_sm');
      }])->first();

      return response()->json([
        'status'    => true,
        'message'   => null,
        'data'      => $created,
      ], 200);
    }
  }

  public function reply(Request $request) {
    $user = Auth::user();

    $validator = Validator::make($request->all(), [
      'dataId'  => 'required',
      'comment' => 'required',
    ]);

    if ($validator->fails()) {    
      return response()->json($validator->messages(), 200);
    }

    $comment                  = new CommentReply;
    $comment->user_id         = $user->id;
    $comment->comment         = $request->dataId;
    $comment->comment_reply   = $request->comment;

    if ($comment->save()) {
      $created = CommentReply::where('id', '=', $comment->id)
      ->with(['user' => function($query) {
        $query->select('id', 'name', 'avatar_sm');
      }])->first();

      return response()->json([
        'status'    => true,
        'message'   => null,
        'data'      => $created,
      ], 200);
    }
  }

  public function thumbsOne(Request $request) {
    $user = Auth::user();

    $validator = Validator::make($request->all(), [
      'dataId'  => 'required',
      'status'  => 'required',
    ]);

    if ($validator->fails()) {    
      return response()->json($validator->messages(), 200);
    }

    $getData = LikeStatus::where('user_id', '=', $user->id)
    ->where('status', '=', $request->dataId)->first();

    if ($getData != null) {
      if ($getData->like_status == 0 && $request->status == 1) {
        $getData->like_status = 1;
      } elseif ($getData->like_status == 1 && $request->status == 1) {
        $getData->like_status = 0;
      } elseif ($getData->like_status == 2 && $request->status == 1) {
        $getData->like_status = 1;
      } elseif ($getData->like_status == 0 && $request->status == 2) {
        $getData->like_status = 2;
      } elseif ($getData->like_status == 1 && $request->status == 2) {
        $getData->like_status = 2;
      } elseif ($getData->like_status == 2 && $request->status == 2) {
        $getData->like_status = 0;
      } else {
        $getData->like_status = 0;
      }
      $getData->save();
    } else {
      $setData = new LikeStatus;
      $setData->user_id = $user->id;
      $setData->status = $request->dataId;
      $setData->like_status = $request->status;
      $setData->save();
    }

    $countUp = LikeStatus::where('status', '=', $request->dataId)
    ->where('like_status', '=', 1)
    ->count();

    $countDown = LikeStatus::where('status', '=', $request->dataId)
    ->where('like_status', '=', 2)
    ->count();

    $resp = array(
      'count_up' => $countUp,
      'count_down' => $countDown,
    );

    return response()->json([
      'status'    => true,
      'message'   => null,
      'data'      => $resp,
    ], 200);
  }

  public function thumbsTwo(Request $request) {
    $user = Auth::user();

    $validator = Validator::make($request->all(), [
      'dataId'  => 'required',
      'status'  => 'required',
    ]);

    if ($validator->fails()) {    
      return response()->json($validator->messages(), 200);
    }

    $getData = LikeComment::where('user_id', '=', $user->id)
    ->where('comment', '=', $request->dataId)->first();

    if ($getData != null) {
      if ($getData->like_status == 0 && $request->status == 1) {
        $getData->like_status = 1;
      } elseif ($getData->like_status == 1 && $request->status == 1) {
        $getData->like_status = 0;
      } elseif ($getData->like_status == 2 && $request->status == 1) {
        $getData->like_status = 1;
      } elseif ($getData->like_status == 0 && $request->status == 2) {
        $getData->like_status = 2;
      } elseif ($getData->like_status == 1 && $request->status == 2) {
        $getData->like_status = 2;
      } elseif ($getData->like_status == 2 && $request->status == 2) {
        $getData->like_status = 0;
      } else {
        $getData->like_status = 0;
      }
      $getData->save();
    } else {
      $setData = new LikeComment;
      $setData->user_id = $user->id;
      $setData->comment = $request->dataId;
      $setData->like_status = $request->status;
      $setData->save();
    }

    $countUp = LikeComment::where('comment', '=', $request->dataId)
    ->where('like_status', '=', 1)
    ->count();

    $countDown = LikeComment::where('comment', '=', $request->dataId)
    ->where('like_status', '=', 2)
    ->count();

    $resp = array(
      'count_up' => $countUp,
      'count_down' => $countDown,
    );

    return response()->json([
      'status'    => true,
      'message'   => null,
      'data'      => $resp,
    ], 200);
  }

  public function thumbsThree(Request $request) {
    $user = Auth::user();

    $validator = Validator::make($request->all(), [
      'dataId'  => 'required',
      'status'  => 'required',
    ]);

    if ($validator->fails()) {    
      return response()->json($validator->messages(), 200);
    }

    $getData = LikeCommentReply::where('user_id', '=', $user->id)
    ->where('comment_reply', '=', $request->dataId)->first();

    if ($getData != null) {
      if ($getData->like_status == 0 && $request->status == 1) {
        $getData->like_status = 1;
      } elseif ($getData->like_status == 1 && $request->status == 1) {
        $getData->like_status = 0;
      } elseif ($getData->like_status == 2 && $request->status == 1) {
        $getData->like_status = 1;
      } elseif ($getData->like_status == 0 && $request->status == 2) {
        $getData->like_status = 2;
      } elseif ($getData->like_status == 1 && $request->status == 2) {
        $getData->like_status = 2;
      } elseif ($getData->like_status == 2 && $request->status == 2) {
        $getData->like_status = 0;
      } else {
        $getData->like_status = 0;
      }
      $getData->save();
    } else {
      $setData = new LikeCommentReply;
      $setData->user_id = $user->id;
      $setData->comment_reply = $request->dataId;
      $setData->like_status = $request->status;
      $setData->save();
    }

    $countUp = LikeCommentReply::where('comment_reply', '=', $request->dataId)
    ->where('like_status', '=', 1)
    ->count();

    $countDown = LikeCommentReply::where('comment_reply', '=', $request->dataId)
    ->where('like_status', '=', 2)
    ->count();

    $resp = array(
      'count_up' => $countUp,
      'count_down' => $countDown,
    );

    return response()->json([
      'status'    => true,
      'message'   => null,
      'data'      => $resp,
    ], 200);
  }

}