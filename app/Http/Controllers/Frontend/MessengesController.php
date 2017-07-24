<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RoomUser;
use App\Room;
use Auth;
use App\Messenges;

class MessengesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function room($id)
    {
    	$room = Room::findOrFail($id);

    	$checkJoin = RoomUser::where('user_id', Auth::id())->where('room_id', $id)->first();
    	if($checkJoin == null){
    		$isJoin = 0;
    	}else{
    		$isJoin = 1;
    	}
    	return view('frontend.messenges.room', compact('isJoin', 'room'));
    }

    public function addRoomMessage(Request $request){
        return Messenges::create([
            'user_id' => $request['user']['id'],
             'room_id' => $request['room']['id'], 
             'content' => $request['message']
             ]);
    }
}
