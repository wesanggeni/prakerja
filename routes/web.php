<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Frontend\DefaultController@index');
Route::get('lab', 'Frontend\DefaultController@lab');

/* auth */
Route::get('register', 'Frontend\DefaultController@register');
Route::get('login', 'Frontend\DefaultController@login');
Route::get('logout', 'AuthController@logout');
Route::post('get-register', 'AuthController@register');
Route::post('get-login', 'AuthController@login');
/* end auth */

Route::get('pekerjaan', 'Frontend\DefaultController@job');

Route::group(['middleware' => 'sentinelmember'], function(){
  Route::group(['prefix' => 'status'], function() {
    Route::get('create', 'Frontend\StatusController@create');
  });
});

Route::group(['middleware' => 'sentineladmin'], function(){
  Route::group(['prefix' => 'amadeus'], function() {
    Route::get('/', 'Backend\DefaultController@index');
  });
});

Route::group(['prefix' => 'amadeus'], function() {
    Route::get('login', 'Backend\DefaultController@login');
    Route::get('logout', 'Backend\DefaultController@logout');
    Route::post('login-process', 'Backend\DefaultController@loginProcess');
});