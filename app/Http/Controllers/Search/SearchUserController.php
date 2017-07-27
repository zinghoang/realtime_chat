<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Messenges;
use App\RoomUser;
use App\Room;

class SearchUserController extends Controller
{
    public function index(Request $request)
    {
        $nameSeach = $request->search;

        $users = User::whereRaw('fullname LIKE "%'.$nameSeach.'%"')
            ->orWhereRaw('name LIKE "%'.$nameSeach.'%"')
            ->orWhereRaw('email LIKE "%'.$nameSeach.'%"')
            ->where('name','!=',Auth::user()->name)->take(20)->get();
        return view('frontend.search.users', compact('users', 'nameSeach'));
    }


    public function inviteUser(Request $request){
        $status = "failed";
    	$username = $request['username'];
    	$user = User::where('name','=',$username)->first();
        
    	if($user){

    	    $status = "success";

            Messenges::create([
                'user_id' => Auth::id(),
                'room_id' => $request['room_id'], 
                'content' => Auth::user()->name . ' invited ' . $user->name . ' into this room.',
                'status' => false
            ]);

            RoomUser::create([
                'user_id' => $user->id,
                'room_id' =>$request['room_id']
            ]);
		}
        $room = Room::find($request['room_id']);

    	return ['user'=> $user,'status' => $status,'room' => $room ];
    }
}
