<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller,Sentinel;
use App\User;
use Illuminate\Support\Facades\Input,Auth;
//--
Use Redirect;
use Illuminate\Support\Str;
use Laravolt\Avatar\Facade as Avatar;

class AuthController extends Controller {

  public function logout() {
    if (Sentinel::logout()) {
      return redirect('/');
    }
  }

  public function login(Request $request) {
    $request->validate([
      'email'     => 'required|email',
      'password'  => 'required|string',
    ]);

    $creds = [
      'email'    => $request->email,
      'password' => $request->password,
    ];

    if ($userCred = Sentinel::authenticate($creds)){
      $user   = User::find($userCred->id);
      $token  = $user->createToken('Prakerja Access')->accessToken;
      $user->token = $token;
      $user->save();
      return redirect('/');
    } else {
      return Redirect::back()->withErrors(['Account not found, please check your email and password']);
    }
  }

  public function register(Request $request) {
    $request->validate([
      'email'     => 'required|email|unique:users|min:5',
      'password'  => 'required|string',
      'firstname' => 'required',
      'lastname'  => 'required',
    ]);

    $avatar = Avatar::create($request->firstname.' '.$request->lastname)->toBase64();

    $creds = [
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
      return redirect('/');
    } else {
      return Redirect::back()->withErrors(['Some mistake, please try again']);
    }
  }

}