<?php

use Illuminate\Http\Request;
use App\Models\Board;

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
 	Route::get('boards/{board}', 'BoardController@show'); // показать одну доску
    Route::put('boards/{board}', 'BoardController@update'); // обновление одной доски
    Route::delete('boards/{board}/users/{user}', 'BoardController@destoryUser'); // удаление пользователей доски
    Route::delete('boards/{board}/status/{status}', 'BoardController@updateStatus'); // удаление пользователей доски
 });


//Route::get('boardsedit')->middleware('can:view, board'); // обновление одной доски
//Route::put('boards/{board}', function (){
//    echo 'update';
//})->middleware('can:update, board');

//Route::post('user/{id}/update', 'UserController@update');
Route::put('setBackground', 'TaskController@setBackground');
Route::get('test', 'UserController@index');
