<?php

namespace App\Http\Controllers\Frontend;

use App\NotifRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;
use Illuminate\Support\Collection;
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
        $listRoomJoined = RoomUser::where('user_id', Auth::user()->id)->get();
        foreach ($listRoomJoined as $room){
            $notif = NotifRoom::where('roomid','=',$room->room->id)
                                ->where('userid','=',Auth::user()->id)
                                ->first();
            $notif != null ? $room->notif = 1 : $room->notif = 0;
        }

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

    public function inviteUser(Request $request){
        $status = "failed";
        $message = ' Invalid Username.';
        $username = $request['username'];
        $user = User::where('name','=',$username)->first();

        
        if($user){

            //Kiem tra user da ton tai trong room

            $roomUser = RoomUser::where('user_id', $user->id)->where('room_id', $request['room_id'])->first();
            if($roomUser == null){

                $status = "success";
                $message = 'Invite Success.';

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
            }else{
                $status = "failed";
                $message = 'User already exists in this room!';
            }
           
        }
        $room = Room::find($request['room_id']);

        return ['user'=> $user,'status' => $status,'room' => $room, 'message' => $message ];
    }

    public function ban($user_id, $room_id, Request $request)
    {
        $room = Room::findOrFail($room_id);
        $user = User::findOrFail($user_id);


        //Khong phai chu phong thi ko cos quyen
        if ($room->user_id != Auth::id()) {
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
        Room::findOrFail($id);

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
    public function deleteNotifRoom(Request $request){
        $roomid = $request->roomid;
        $userid = $request->userid;
        $notif = NotifRoom::where('roomid','=',$roomid)
            ->where('userid','=',$userid)
            ->first();
        if($notif != null){
            $delete = NotifRoom::findOrFail($notif->id);
            $delete->delete();
        }
    }
    public function reloadListRoom(Request $request){
       $listRoom = DB::table('rooms')
            ->join('room_users','rooms.id','=','room_users.room_id')
            ->join('messenges','rooms.id','=','messenges.room_id')
            ->where('room_users.user_id','=',Auth::user()->id)
            ->orderBy('messenges.created_at','DESC')
            ->select('rooms.id')->get();
        $arr_roomid = array();
        foreach ($listRoom as $room){
            array_push($arr_roomid,$room->id);
        }
        $arr_roomid = array_unique($arr_roomid);
        $arr_roomidLoad = array_slice($arr_roomid,0,3);
        $rooms = new Collection();
        foreach ($arr_roomidLoad as $roomid){
            $room = Room::findOrFail($roomid);
            if($room != null){
                $notifRoom = NotifRoom::where('roomid','=',$roomid)
                    ->where('userid','=',Auth::user()->id)
                    ->first();
                $notifRoom != null ? $room->notif = 1 : $room->notif = 0;
                $rooms->push($room);
            }
        }
        $stringDivData = "";
        foreach ($rooms as $room){
            $stringDivData = $stringDivData . "<div class=\"lv-item media";
            if($room->id == intval($request->roomid)){
                $stringDivData = $stringDivData ." active" ;
            };
            $stringDivData = $stringDivData . "\">"
                ."<div class=\"lv-avatar pull-left\">"
                ."<img src=\"../../images/home.png\" alt=\"\">"
                ."</div>"
                ."<div class=\"media-body\">"
                ."<div class=\"lv-title\">"
                ."<a href=\"/message/room/".$room->id."\" title=\"$room->name\" style=\"text-decoration:none;\">"
                .str_limit($room->name,12)."</a>";
            if($room->notif == 1 && $room->id != intval($request->roomid)){
                $stringDivData = $stringDivData . "<i class=\"fa fa-star\" aria-hidden=\"true\" style=\"color: #aa1111;padding-left: 10px\"></i>";
            }
            $stringDivData = $stringDivData . "</div><div class=\"lv-small\"> Click here to chat... </div></div></div>";
        }
//        //kiem tra xem con thong bao nao nua~ hay khong
        $moreNotif = 0; //mac dinh la khong co
        if(count($arr_roomid) > 3){
            $arr_roomidUnload = array_slice($arr_roomid,3,count($arr_roomid)-3);
            //kiem tra nhung room con lai co thong bao hay khong
            foreach ($arr_roomidUnload as $roomidd) {
                $notif = NotifRoom::where('roomid', '=', $roomidd)
                    ->where('userid', '=', Auth::user()->id)
                    ->first();
                if ($notif != null) {
                    $moreNotif++;
                }
            }
        }
        $stringDivData = $stringDivData . "<div class=\"lv-item media\"><div class=\"media-body\">"
                                    ."<p class=\"text-center\" style=\"margin: 0px;\">"
			                            ."<a href=\"/room\" title=\"\" style=\"text-decoration:none;\">"."SHOW ALL ROOMS";
        if($moreNotif > 0){
            $stringDivData = $stringDivData . "<strong style=\"color: red;padding-left:10px\">[ " . $moreNotif. " ]</strong>";
        }
        $stringDivData = $stringDivData ."</a>"."</p>"."</div></div>";
        echo $stringDivData;
    }
}
