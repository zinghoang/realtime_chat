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

Route::group(['prefix'=> 'admin','namespace'=>'BackEnd'],function (){
    Route::resource('users', 'UserController');
    Route::resource('rooms', 'RoomController');
    Route::resource('emotions', 'EmotionController');
    Route::resource('files', 'FileController');
});

Route::group(['namespace' => 'Frontend'], function(){
	Route::get('/home', 'HomeController@index')->name('home');

	Route::group(['prefix' => 'message'], function(){
		Route::get('/room/{room}', 'MessengesController@room')->name('frontend.message.room');
	});

	Route::group(['prefix' => 'room'], function(){
		Route::get('/', 'RoomController@index')->name('frontend.room.index');
		Route::get('/create', 'RoomController@create')->name('frontend.room.create');
		Route::post('/', 'RoomController@store')->name('frontend.room.store');
	});

});

Auth::routes();

//Route::get('/', 'HomeController@index')->name('frontend.home.index');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
