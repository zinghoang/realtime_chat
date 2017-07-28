<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\RoomUser;
use App\Http\Requests\RoomRequest;
use App\File;
use App\User;
use App\Messenges;
use Auth;


class RoomController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $listRoomJoined = RoomUser::where('user_id', Auth::id())->get();
        $arrayRoomJoin = array_pluck($listRoomJoined->toArray(), 'room_id');
        $listRoomRandom = DB::table('rooms')->whereNotIn('id', $arrayRoomJoin)->orderByRaw("RAND()")->take(16)->get();
        return view('frontend.rooms.index', compact('listRoomJoined', 'listRoomRandom'));
    }

    public function create()
    {
    	return view('frontend.rooms.create');
    }

    public function store(RoomRequest $request)
    {
        $room = new Room;
        $room->name = $request->name;
        $room->user_id = Auth::id();
        $room->save();

        $roomUser = new RoomUser;
        $roomUser->user_id = Auth::id();
        $roomUser->room_id = $room->id;
        $roomUser->save();

        $message = new Messenges;
        $message->user_id = Auth::user()->id;
        $message->room_id = $room->id;
        $message->content = Auth::user()->name . ' has created this room';
        $message->status = 0;
        $message->save();
        return redirect()->route('frontend.message.room', $room->id);
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);

        $checkJoin = RoomUser::where('user_id', Auth::id())->where('room_id', $id)->first();
        if($checkJoin == null){
            $isJoin = 0;
        }else{
            $isJoin = 1;
        }
        $listMemberOrRoom = RoomUser::where('room_id', $id)->get();
        return view('frontend.rooms.show', compact('isJoin', 'room', 'listMemberOrRoom'));
    }

    public function invite($id)
    {
    	//
    }

    public function ban($user_id, $room_id, Request $request)
    {
        $room = Room::findOrFail($room_id);
        $user = User::findOrFail($user_id);



        //Khong phai chu phong thi ko cos quyen
        if ($room->id != Auth::id()) {
            $request->session()->flash('danger','You must not to do this action!');
            return redirect()->route('frontend.room.show', $room_id);
        }

        //Ban chinh minh thi leave group
        if ($user_id == Auth::id()) {
            return $this->leave($room_id);
        }

        $roomUser = RoomUser::where('user_id', $user_id)->where('room_id', $room_id)->first();
        $roomUser->delete();

        //add message leave to db
        Messenges::create([
            'user_id' => Auth::id(),
            'room_id' => $room_id, 
            'content' => Auth::user()->name . ' has banned user ' . $user->name . ' out the room',
            'status' => false
        ]);

        return redirect()->route('frontend.room.show', $room_id);
    }

    public function leave($id)
    {
        $room = Room::findOrFail($id);

        $roomUser = RoomUser::where('user_id', Auth::id())->where('room_id', $id)->first();
        if($roomUser != null){
            $roomUser->delete();
        }else{
            return redirect()->route('frontend.message.room', $id);
        }

        //add message leave to db
        Messenges::create([
            'user_id' => Auth::id(),
            'room_id' => $id, 
            'content' => Auth::user()->name . ' has left',
            'status' => false
        ]);

        // Delete room when nobody in room
        $checkRoomMember = RoomUser::where('room_id', $id)->get();

        if(count($checkRoomMember) == 0){
            RoomUser::where('room_id', $id)->delete();
            Messenges::where('room_id', $id)->delete();
            $files = File::where('room_id', $id)->get();

            foreach ($files as $key => $file) {
                Storage::delete('public/media/'.$file->name);
            }

            $room->delete();

            return redirect()->route('frontend.room.index');
        }

        return redirect()->route('frontend.message.room', $id);
    }

    public function join($id)
    {
        $room = Room::findOrFail($id);

        //Check Joined RoomUser 
        $roomUser = RoomUser::where('user_id', Auth::id())->where('room_id', $id)->first();

        if ($roomUser == null) {
            
            //Add RoomUser
            $roomUser = new RoomUser;
            $roomUser->user_id = Auth::id();
            $roomUser->room_id = $id;
            $roomUser->save();

            Messenges::create([
                'user_id' => Auth::id(),
                'room_id' => $id, 
                'content' => Auth::user()->name . ' has joined',
                'status' => false
            ]);
        }

        return redirect()->route('frontend.message.room', $id);
    }

    public function edit($id)
    {
        return redirect()->route('frontend.message.room', $id);
    }

    public function update(RoomRequest $request, $id)
    {
        $room = Room::findOrFail($id);

        if ($room->user_id != Auth::id()) {
            abort(404);
        }
        $room->name = $request->name;
        $room->save();

        return $request->name;
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        if ($room->user_id != Auth::id()) {
            abort(404);
        }

        RoomUser::where('room_id', $id)->delete();
        Messenges::where('room_id', $id)->delete();
        $files = File::where('room_id', $id)->get();

        foreach ($files as $key => $file) {
            Storage::delete('public/media/'.$file->name);
        }

        $room->delete();

        return redirect()->route('frontend.room.index');
    }

    public function changeVideo($room_id, Request $request){
        $file_id = $request->file_id;
        $file = File::where('room_id', $room_id)->where('id', $file_id)->first();

        return asset('storage/media/'.$file->name);
    }
}
