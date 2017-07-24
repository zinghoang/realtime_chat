<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;
use Illuminate\Support\Facades\DB;
use App\RoomUser;
use Auth;


class RoomController extends Controller
{
    public function index()
    {
        $listRoomJoined = RoomUser::where('user_id', Auth::id())->get();

        $arrayRoomJoin = array_pluck($listRoomJoined->toArray(), 'room_id');

        $listRoomRandom = DB::table('rooms')->whereNotIn('id', $arrayRoomJoin)->get();


        return view('frontend.rooms.index', compact('listRoomJoined', 'listRoomRandom'));
    }

    public function create()
    {
    	return view('frontend.rooms.create');
    }

    public function store(Request $request)
    {
        $room = new Room;
        $room->name = $request->name;
        $room->save();


        $roomUser = new RoomUser;
        $roomUser->user_id = Auth::id();
        $roomUser->room_id = $room->id;
        $roomUser->save();

        return redirect()->route('frontend.message.room', $room->id);
    }

    public function show($id)
    {
        return view('frontend.rooms.show');
    }

    public function invite($id)
    {
    	//
    }

    public function leave($id)
    {
        $room = Room::findOrFail($id);

        $roomUser = RoomUser::where('user_id', Auth::id())->where('room_id', $id)->first();
        $roomUser->delete();

        return redirect()->route('frontend.message.room', $id);
    }

    public function join($id)
    {
        $room = Room::findOrFail($id);

        $roomUser = new RoomUser;
        $roomUser->user_id = Auth::id();
        $roomUser->room_id = $id;
        $roomUser->save();

        return redirect()->route('frontend.message.room', $id);
    }

    public function edit($id)
    {
        return redirect()->route('frontend.message.room', $id);
    }

    public function update(Request $request, $id)
    {
        $room = Room::find($id);
        $room->name = $request->name;
        $room->save();

        return redirect()->route('frontend.message.room', $room->id);
    }

    public function destroy($id)
    {
        //
    }
}
