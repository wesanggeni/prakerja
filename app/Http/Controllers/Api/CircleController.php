<?php
namespace App\Http\Controllers\Api;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller,Sentinel;
use App\User;
use App\Circle;
use Illuminate\Support\Facades\Input,Validator,Auth;
//--

class CircleController extends Controller {

  public function index() { }

  public function create(Request $request) {
    $user = Auth::user();

    $validator = Validator::make($request->all(), [
      'dataId'  => 'required|string',
    ]);

    if ($validator->fails()) {    
      return response()->json($validator->messages(), 200);
    }

    $insertThis           = new Circle;
    $insertThis->user_id  = $user->id;
    $insertThis->circle   = $request->dataId;

    if ($insertThis->save()) {
      return response()->json([
        'status'    => true,
        'message'   => null,
        'data'      => null,
      ], 200);
    }
  }


}