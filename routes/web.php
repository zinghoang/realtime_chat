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
		
		Route::get('/room/upload/{room}', 'MessengesController@room');
		Route::post('/room/upload/{room}', 'MessengesController@uploadFile')->name('frontend.message.uploadfile');
		
		Route::post('/add-room-message','MessengesController@addRoomMessage');
	});

	Route::group(['prefix' => 'room'], function(){
		Route::get('/', 'RoomController@index')->name('frontend.room.index');
		Route::post('/', 'RoomController@store')->name('frontend.room.store');

		Route::get('/{room}', 'RoomController@show')->name('frontend.room.show');
		Route::get('/{room}/edit', 'RoomController@edit')->name('frontend.room.edit');
		Route::put('/{room}', 'RoomController@update')->name('frontend.room.update');
		Route::delete('/{room}', 'RoomController@destroy')->name('frontend.room.destroy');

		Route::get('/join/{room}', 'RoomController@join')->name('frontend.room.join');
		Route::get('/leave/{room}', 'RoomController@leave')->name('frontend.room.leave');

		Route::post('/video/{room}', 'RoomController@changeVideo')->name('frontend.room.changeVideo');
	});

	Route::group(['prefix' => 'chat'], function(){
		Route::get('/', 'PrivateChatController@index')->name('frontend.private.index');
		Route::get('/{username}', 'PrivateChatController@user')->name('private.user');
		Route::post('/addprivatemess','PrivateChatController@addPrivateMess');
		Route::get('/requestRelationship/{user_id}','PrivateChatController@requestRelationship')->name('requestRelationship');
		Route::get('/deleteRelationship/{id}','PrivateChatController@deleteRelationship')->name('deleteRelationship');
		Route::get('/acceptRelationship/{id}','PrivateChatController@acceptRelationship')->name('acceptRelationship');
        Route::post('/deleteNotif','PrivateChatController@deleteNotif')->name('deleteNotif');
	});

    Route::resource('account', 'AccountController', ['only' => [
	    'edit', 'update'
	]]);
    
});

Route::get('search', 'Search\SearchUserRoomController@index')->name('SearchUser');
Route::get('inviteUser','Search\SearchUserController@inviteUser');

Auth::routes();


//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/', 'HomeController@index')->name('frontend.home.index');
 
//Route::get('/', 'HomeController@index')->name('frontend.home.index');

Route::get('/', function () {
    return view('welcome');
});

