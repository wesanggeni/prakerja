<?php
namespace App\Http\Controllers\Frontend;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller,Sentinel;
use App\Users;
use Illuminate\Support\Facades\Input,Validator,Auth;
//--

class DefaultController extends Controller {

  public function lab() {
    $avatar = Avatar::create('Setan Alasss')->toBase64();
    echo '<img src="'.$avatar.'">';
  }

  public function index() {
    return view('frontend/home');
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