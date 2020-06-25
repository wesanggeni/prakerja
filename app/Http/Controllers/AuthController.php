<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller,Sentinel;
use App\User;
use Illuminate\Support\Facades\Input,Auth,File,Image;
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

  public static function resize($path, $width = 412, $height = 412) {
    $image = Image::make($path)->resize($width, $height);
    $result = $image->save($path);
    return $path;
  }

  public function register(Request $request) {
    $request->validate([
      'email'     => 'required|email|unique:users|min:5',
      'password'  => 'required|string',
      'firstname' => 'required',
      'lastname'  => 'required',
    ]);

    $name = ucwords(strtolower($request->firstname)).' '.ucwords(strtolower($request->lastname));
    $lastId = User::latest('id')->first();
    $getId = 1;
    if ($lastId != null) {
      $getId = $lastId->id + 1;
    }

    if(!File::exists('img/'.$getId)) {
      File::makeDirectory('img/'.$getId);
    }
    $saveAsLg = 'img/'.$getId.'/avatar-lg.jpg';
    $saveAsMd = 'img/'.$getId.'/avatar-md.jpg';
    $saveAsSm = 'img/'.$getId.'/avatar-sm.jpg';

    Avatar::create($name)->save($saveAsLg);
    Avatar::create($name)->save($saveAsMd);
    Avatar::create($name)->save($saveAsSm);

    $this->resize($saveAsLg, 412, 412);
    //$this->resize($saveAsMd, 120, 120);
    $this->resize($saveAsSm, 32, 32);

    $creds = [
      'name'        => $name,
      'first_name'  => ucwords(strtolower($request->firstname)),
      'last_name'   => ucwords(strtolower($request->lastname)),
      'email'       => $request->email,
      'password'    => $request->password,
      'avatar_lg'   => $saveAsLg,
      'avatar_md'   => $saveAsMd,
      'avatar_sm'   => $saveAsSm,
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

      return redirect('/');
    } else {
      return Redirect::back()->withErrors(['Some mistake, please try again']);
    }
  }

}