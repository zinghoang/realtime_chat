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
    Route::get('/index','HomeController@index')->name('admin.index')->middleware('CheckAdmin');
});

Route::group(['namespace' => 'Frontend'], function(){
	Route::get('/home', 'HomeController@index')->name('home');

	Route::group(['prefix' => 'message'], function(){
		Route::get('/room/{room}', 'MessengesController@room')->name('frontend.message.room');
	});

	Route::group(['prefix' => 'room'], function(){
		Route::get('/', 'RoomController@index')->name('frontend.room.index');
		Route::post('/', 'RoomController@store')->name('frontend.room.store');
	});

	Route::group(['prefix' => 'chat'], function(){
		Route::get('/', 'PrivateChatController@index')->name('frontend.private.index');
		Route::get('/{username}', 'PrivateChatController@user')->name('private.user');
		Route::post('/addprivatemess','PrivateChatController@addPrivateMess');
	});
    Route::resource('account', 'AccountController');
});

Route::get('search', 'Search\SearchUserController@index')->name('SearchUser');

Auth::routes();


//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/', 'HomeController@index')->name('frontend.home.index');
 
//Route::get('/', 'HomeController@index')->name('frontend.home.index');

Route::get('/', function () {
    return view('welcome');
});

