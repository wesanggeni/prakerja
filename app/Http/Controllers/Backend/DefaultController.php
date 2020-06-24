<?php
namespace App\Http\Controllers\Backend;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller,Sentinel;
use App\Users;
use Illuminate\Support\Facades\Input;

class DefaultController extends Controller {

  public function index() {
    return view('backend/dashboard');
  }

  public function login() {
    /*
    $credentials = [
        'email'    => 'pray3717@gmail.com',
        'password' => '@WesanggenI3717',
    ];

    $user = Sentinel::registerAndActivate($credentials);
    $role = Sentinel::findRoleByName('admin');
    $role->users()->attach($user);
    */
    return view('backend/login');
  }

  public function logout() {
    if (Sentinel::logout()) {
      return redirect('amadeus/login');
    }
  }

  public function loginProcess(Request $request) {
    $validator = $request->validate([
      'email' => 'required',
      'password' => 'required',
    ]);

    if ($validator == true) {

      $creds = [
          'email'    => $request->email,
          'password' => $request->password,
      ];

      if ($user = Sentinel::authenticate($creds)){
        if (Sentinel::inRole('admin')) {
          return redirect('amadeus');
        }
        return redirect('/');
      }
    }
  }

}