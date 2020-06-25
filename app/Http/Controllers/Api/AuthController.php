<?php
namespace App\Http\Controllers\Api;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller,Sentinel;
use App\User;
use Illuminate\Support\Facades\Input,Validator,Auth;
//--
use Illuminate\Support\Str;
use Laravolt\Avatar\Facade as Avatar;

class AuthController extends Controller {

  public function index() {
    return response()->json([
      'status'  => false,
      'message' => 'please login first!',
      'data'    => null,
    ], 200);
  }

  public function logout() {
    if (Sentinel::logout()) {
      return redirect('/');
    }
  }

  public function login(Request $request) {
    $validator = Validator::make($request->all(), [
      'email'     => 'required|email',
      'password'  => 'required|string',
    ]);

    if ($validator->fails()) {    
      return response()->json($validator->messages(), 200);
    }

    $creds = [
      'email'    => $request->email,
      'password' => $request->password,
    ];

    if ($userCred = Sentinel::authenticate($creds)){
      $user   = User::find($userCred->id);
      $token  = $user->createToken('Prakerja Access')->accessToken;

      return response()->json([
        'status'        => true,
        'message'       => null,
        'data'          => $user,
      ], 200);

    } else {
      return response()->json([
        'status'  => false,
        'message' => 'account not found, please correct your data',
        'data'    => null,
      ], 200);
    }
  }

  public function register(Request $request) {
    $validator = Validator::make($request->all(), [
      'email'     => 'required|email|unique:users|min:5',
      'password'  => 'required|string',
      'firstname' => 'required',
      'lastname'  => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'status'  => false,
        'message' => $validator->messages(),
        'data'    => null,
      ], 200);
    }

    $avatar = Avatar::create($request->firstname.' '.$request->lastname)->toBase64();

    $creds = [
      'name'        => ucwords(strtolower($request->firstname)).' '.ucwords(strtolower($request->lastname)),
      'first_name'  => ucwords(strtolower($request->firstname)),
      'last_name'   => ucwords(strtolower($request->lastname)),
      'email'       => $request->email,
      'password'    => $request->password,
      'avatar'      => $avatar,
    ];

    if ($user = Sentinel::registerAndActivate($creds)) {
      $role = Sentinel::findRoleByName('member');
      $role->users()->attach($user);
      //-- login
      Sentinel::authenticate($creds);
      $userLogin  = User::find($user->id);
      $token      = $userLogin->createToken('Prakerja Access')->accessToken;
      $userLogin->token = $token;
      $userLogin->save();

      return response()->json([
        'status'        => true,
        'message'       => null,
        'data'          => $user,
        'access_token'  => $token,
      ], 200);
    }
  }

}