<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

 Route::middleware('auth:api')->group(function () {
 	Route::put('users/{id}/update', 'UserController@update');
 });


//Route::middleware('auth')->group(function () {
//});


//Route::post('user/{id}/update', 'UserController@update');
Route::get('user', 'UserController@index');
Route::put('setBackground', 'TaskController@setBackground');
Route::get('test', 'UserController@index');
