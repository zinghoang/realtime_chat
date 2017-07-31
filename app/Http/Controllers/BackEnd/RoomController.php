<?php

namespace App\Http\Controllers\BackEnd;

use App\File;
use App\Http\Requests\RoomRequest;
use App\Messenges;
use App\NotifRoom;
use App\Room;
use App\RoomUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CheckAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::orderBy('id','DESC')->paginate(15);
        return view('backend.rooms.index')->with('rooms',$rooms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        $name = $request->name;
        $room = new Room();
        $room->name = $name;
        $room->save();
        $request->session()->flash('success','Room was added successful!');
        return redirect()->route('rooms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('backend.rooms.show')->with('room',$room);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('backend.rooms.edit')->with('room',$room);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequest $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->name = $request->name;
        $room->save();
        $request->session()->flash('success','Room was updated successful!');
        return redirect()->route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        //xoa het thanh vien trong room ra khoi bang room_user
        $room_user = RoomUser::where('room_id','=', $room->id)->delete();
        //xoa het msg trong room
        $msg = Messenges::where('room_id','=',$room->id)->delete();
        //xoa het file trong room
            //lay list file
            $files = File::where('room_id','=',$room->id)->get();
            foreach ($files as $file){
                \Illuminate\Support\Facades\File::delete('storage/media/'.$file->name);
                $file->delete();
            }
        //xoa het notification cua room
        $notif = NotifRoom::where('roomid','=',$room->id)->delete();
        //xoa room
        $room->delete();
        $request->session()->flash('success',$room->name.' is deleted successfully!');
        return redirect()->route('rooms.index');
    }
}
