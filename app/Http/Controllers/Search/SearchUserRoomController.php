<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Messenges;
use App\RoomUser;
use App\Room;

class SearchUserRoomController extends Controller
{
    public function index(Request $request)
    {
        $nameSeach = $request->search;

        $users = User::whereRaw('fullname LIKE "%'.$nameSeach.'%"')
            ->orWhereRaw('name LIKE "%'.$nameSeach.'%"')
            ->orWhereRaw('email LIKE "%'.$nameSeach.'%"')
            ->where('name','!=',Auth::user()->name)->take(10)->get();

        $rooms = Room::whereRaw('name LIKE "%'.$nameSeach.'%"')
            ->take(10)->get();

        return view('frontend.search.users', compact('users', 'nameSeach', 'rooms'));
    }


    
}
