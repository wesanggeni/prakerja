<?php
namespace App\Http\Controllers\Api;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller,Sentinel;
use App\User;
use App\Status;
use Illuminate\Support\Facades\Input,Validator,Auth;
//--

class StatusController extends Controller {

  public function lab() {
    $user = Auth::user();
    print_r($user);
    //return view('frontend/home');
  }

  public function index() {
    return view('frontend/home');
  }

  public function statusCreate(Request $request) {
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
      return response()->json([
        'status'    => true,
        'message'   => null,
        'data'      => $status,
      ], 200);
    }
  }


}