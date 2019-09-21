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
// Route::get('/test', function(){
// 	return view('test');
// });

Route::group(['prefix' => 'admin007'], function () {
    Voyager::routes();
});
Auth::routes();
Route::get('/about','HomeController@index');
Route::get('/{date?}','MovieController@index');
Route::get('/details/{movie_id}','MovieController@show');
Route::get('/tickets/{movie_id}','SeatController@index');
Route::get('/tickets/test',function(){
	return new reservedMail();
});
Route::post('/tickets','SeatController@store');

//Route::get('/home', 'HomeController@index')->name('home');






