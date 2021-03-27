<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth.bearer'], function() {
    Route::get('users', 'App\Http\Controllers\UsersController@getList');
    Route::post('users/create', 'App\Http\Controllers\UsersController@create');
    Route::post('users/update/{users}', 'App\Http\Controllers\UsersController@update');
});