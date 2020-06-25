<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('login', ['as' => 'login', 'uses' => 'Api\AuthController@index']);

Route::group(['namespace' => 'Api', 'prefix' => 'auth'], function () {
	Route::post('register', 'AuthController@register');
	Route::post('login', 'AuthController@login');
});

Route::group(['namespace' => 'Api', 'prefix' => 'circle', 'middleware' => 'auth:api'], function () {
	Route::post('create', 'CircleController@create');
});

Route::group(['namespace' => 'Api', 'prefix' => 'status', 'middleware' => 'auth:api'], function () {
  Route::get('/', 'StatusController@index');
	Route::post('create', 'StatusController@create');
  Route::post('thumbs-one', 'StatusController@thumbsOne');
  Route::post('thumbs-two', 'StatusController@thumbsTwo');
  Route::post('thumbs-three', 'StatusController@thumbsThree');
  Route::post('comment', 'StatusController@comment');
  Route::post('reply', 'StatusController@reply');
  Route::post('get-comment', 'StatusController@getComment');
	Route::post('get-reply', 'StatusController@getReply');
});
