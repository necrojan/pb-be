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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('users', '\App\Http\Controllers\UsersController@index');
    Route::post('users', '\App\Http\Controllers\UsersController@store');
    Route::get('users/{user}', '\App\Http\Controllers\UsersController@get');
    Route::put('users/{user}', '\App\Http\Controllers\UsersController@update');
    Route::delete('users/{user}', '\App\Http\Controllers\UsersController@destroy');
});
