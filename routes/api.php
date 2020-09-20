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
    //user
    Route::post('users', 'UserController@update');

 	//board
 	Route::get('boards', 'BoardController@index'); // показать все доски
 	Route::post('boards', 'BoardController@store'); // создание новой доски
 	Route::get('boards/{id}', 'BoardController@show'); // показать одну доску
 	Route::put('boards/{id}', 'BoardController@update'); // обновление одной доски
 });


//Route::middleware('auth')->group(function () {
//});


//Route::post('user/{id}/update', 'UserController@update');
Route::put('setBackground', 'TaskController@setBackground');
Route::get('test', 'UserController@index');
