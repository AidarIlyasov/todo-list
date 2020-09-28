<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::get('/admin', function() {
	echo "admin page";
});

Route::get('/', function () {
    return view('app');
})->middleware('auth');


Route::get('logout', function(){
  Auth::logout();
  return view('auth.login');
});

Route::get('test', 'UserController@test');;

//Route::get('edit', 'BoardController@edit');

// Route::get('/store', 'UserController@store');
