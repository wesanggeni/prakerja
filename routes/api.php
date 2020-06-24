<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('login', ['as' => 'login', 'uses' => 'Api\AuthController@index']);

Route::group(['namespace' => 'Api', 'prefix' => 'auth'], function () {
	Route::post('register', 'AuthController@register');
	Route::post('login', 'AuthController@login');
});

Route::group(['namespace' => 'Api', 'prefix' => 'status', 'middleware' => 'auth:api'], function () {
	Route::post('create', 'StatusController@statusCreate');
	Route::get('lab', 'StatusController@lab');
});
