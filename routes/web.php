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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=> 'admin','namespace'=>'BackEnd'],function (){
    Route::resource('user', 'UserController');
    Route::resource('room', 'RoomController');
    Route::resource('emotion', 'EmotionController');
    Route::resource('file', 'FileController');
});