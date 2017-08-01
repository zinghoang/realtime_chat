<?php

namespace App\Http\Controllers\Frontend;

use App\Emotion;
use App\NotifRoom;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RoomUser;
use App\Room;
use App\File;
use Auth;
use App\Messenges;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\FileRequest;

class MessengesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function room($id)
    {
        //xoa thong bao tu room -> auth::user
        $notif = NotifRoom::where('roomid','=',$id)
                        ->where('userid','=',Auth::user()->id)
                        ->first();
        if($notif != null){
            $notif = NotifRoom::findOrFail($notif->id);
            $notif->delete();
        }
        $room = Room::findOrFail($id);

    	$checkJoin = RoomUser::where('user_id', Auth::id())->where('room_id', $id)->first();
    	if($checkJoin == null){
    		$isJoin = 0;
    	}else{
    		$isJoin = 1;
    	}
    	$listTemp = DB::table('messenges')
            ->join('users','users.id','=','messenges.user_id')
            ->where('messenges.room_id', $id)
            ->select('users.avatar','users.name','users.fullname', 'messenges.*')
            ->take(10)
            ->orderBy('messenges.id','DESC')
            ->get();
    	$messages = new Collection();
    	for ($i = $listTemp->count()-1 ; $i >= 0 ; $i--){
            $messages->push($listTemp[$i]);
        }
        foreach ($messages as $key => $chat){
            $chat->content = self::getNewContent($chat->content);
        }

        $listMemberOrRoom = RoomUser::where('room_id', $id)->get()->toArray();
        $countMember = count($listMemberOrRoom);

        $listFile = File::where('room_id', $id)->get();
    	return view('frontend.messenges.room', compact('isJoin', 'room','messages','listFile', 'countMember'));
    }

    public function uploadFile(Request $request, $id)
    {
        //Check Join the room
        $checkJoin = RoomUser::where('user_id', Auth::id())->where('room_id', $id)->first();

        if($checkJoin == null){
            return redirect()->route('frontend.message.room', $id);
        }

        //Get name file 
        $nameFileSave = $request->file('upload')->getClientOriginalName();
        $ar_name_file = explode('.', $nameFileSave);
        $formatFile = end($ar_name_file);

        //check file
        if ($formatFile != 'mp4' && $formatFile != 'avi' && $formatFile != 'mp3' && $formatFile != 'mpga' && $formatFile != 'mpeg') {
            
            $request->session()->flash('danger', 'The title must be a file of type: mp4, avi, mp3.');
            
            return redirect()->route('frontend.message.room', $id);
        }

        //Save file
        $name = $request->file('upload')->store('public/media');
        $ar_name = explode('/', $name);
        $nameFile = end($ar_name);

        //Get type of file
        if ($formatFile === 'mp4' || $formatFile === 'avi') {
            $type = 'video';
        }elseif ($formatFile === 'mpga' || $formatFile === 'mpga') {
            $type = 'sound';
        }else{
            $type = 'nas';
        }

        //Get name file
        $nameFileSave = str_replace('.' . $formatFile, '', $nameFileSave);

        $file = new File();
        $file->room_id = $id;
        $file->name = $nameFile;
        $file->type = $type;
        if($request->title == ""){
            $file->title = $nameFileSave;
        }else{
            $file->title = $request->title;
        }
        $file->user_id = Auth::id();
        $file->save();

        $message = new Messenges;
        $message->user_id = Auth::user()->id;
        $message->room_id = $id;
        $message->content = Auth::user()->name . ' has uploaded file: ' . $nameFileSave;
        $message->status = 0;
        $message->save();

        $request->session()->flash('fileUpload',$file->id."|".$file->title."|".$file->type."|".$message->content."|".Auth::user()->fullname);

       return redirect()->route('frontend.message.room', $id);
    }

    public function deleteFile($id, Request $request)
    {        
        $file = File::findOrFail($id);
        $room = Room::findOrFail($file->room_id);
        

        if ($file->user_id != Auth::id() && $room->user_id != Auth::id()) {
            $request->session()->flash('danger','You must not to do this action!');
            return redirect()->route('frontend.message.room', $file->room_id);
        }
        //Xoa file
        \Illuminate\Support\Facades\File::delete('storage/media/'.$file->name);

        //add message
        $message = new Messenges;
        $message->user_id = Auth::user()->id;
        $message->room_id = $file->room_id;
        $message->content = Auth::user()->name . ' has deleted file: ' . $file->title;
        $message->status = 0;
        $message->save();

        //Xoa record trong CSDL
        $file->delete();
        $request->session()->flash('fileDelete',$file->id."|".$file->title."|".$file->type."|".$message->content."|".Auth::user()->fullname);
        $request->session()->flash('success','Removed Successful');
        return redirect()->route('frontend.message.room', $file->room_id);

    }
        
    public function addRoomMessage(Request $request){
     //   \Log::info($request);
        $message = new Messenges();
        $message->user_id = $request['user']['id'];
        $message->room_id = $request['room']['id'];
        $message->content = $request['message'];
        $message->status = true;
        $message->save();
        //xoa thong bao tu room, neu co
        $notif = NotifRoom::where('roomid','=',$message->room_id)
                            ->where('userid','=',Auth::user()->id)
                            ->first();
        if ($notif != null){
            $notif = NotifRoom::findOrFail($notif->id);
            $notif->delete();
        }
        //1- gui thong bao den cac thanh vien trong room
        $user_ids = RoomUser::where('room_id','=',$request['room']['id'])
                                    ->where('user_id','!=',Auth::user()->id)
                                    ->select('user_id')->get();
        foreach ($user_ids as $user_id) {
            $notifRoom = NotifRoom::where('roomid', '=', $request['room']['id'])
                    ->where('userid', '=', $user_id->user_id)
                    ->first();
            if ($notifRoom == null) {
                $notifRoom = new NotifRoom;
                $notifRoom->roomid = $request['room']['id'];
                $notifRoom->userid = $user_id->user_id;
                $notifRoom->status = 0;
                $notifRoom->save();
            }
        }
        //cap nhat list room cua user gui~
        $listRoomFrom = DB::table('rooms')
            ->join('room_users','rooms.id','=','room_users.room_id')
            ->join('messenges','rooms.id','=','messenges.room_id')
            ->where('room_users.user_id','=',Auth::user()->id)
            ->orderBy('messenges.created_at','DESC')
            ->select('rooms.id')->get();
        $arr_roomid = array();
        foreach ($listRoomFrom as $room){
            array_push($arr_roomid,$room->id);
        }
        $arr_roomid = array_unique($arr_roomid);
        $arr_roomidLoad = array_slice($arr_roomid,0,3);
        $roomsFrom = new Collection();
        foreach ($arr_roomidLoad as $roomid){
            $room = Room::findOrFail($roomid);
            if($room != null){
                $notifRoom = NotifRoom::where('roomid','=',$roomid)
                    ->where('userid','=',$request['user']['id'])
                    ->first();
                $notifRoom != null ? $room->notif = 1 : $room->notif = 0;
                $roomsFrom->push($room);
            }
        }
        $message->roomsFrom = $roomsFrom;

        //kiem tra xem con thong bao nao nua~ hay khong
        $moreNotif = 0; //mac dinh la khong co
        if(count($arr_roomid) > 3){
            $arr_roomidUnload = array_slice($arr_roomid,3,count($arr_roomid)-3);
            //kiem tra nhung room con lai co thong bao hay khong
            foreach ($arr_roomidUnload as $roomid){
                $notif = NotifRoom::where('roomid','=',$roomid)
                    ->where('userid','=',Auth::user()->id)
                    ->first();
                if($notif != null){
                    $moreNotif++;
                }
            }
        }
        $message->moreNotif = $moreNotif;
        $message->content = self::getNewContent($message->content);
        $user_send = User::where('id','=',$message->user_id)->select('name','fullname','avatar')->first();
        $message->avatar = $user_send->avatar;
        $message->username = $user_send->name;
        $message->fullname = $user_send->fullname;
        $room_userid = Room::findOrFail($request['room']['id']);
        if ($room_userid == null) {
            abort(404);
        }
        $message->room_userid = $room_userid->user_id;
        return $message;
    }
    public static function getNewContent($content)
    {
        $output = "";
        $arr_text = explode(" ",$content);
        foreach ($arr_text as $str){
            $code = $str;
            $image = Emotion::where('code','=',$code)
                ->select('image')->first();
            if($image == null){
                $output = $output. " ".$code;
            }else{
                $output = $output. " "."<img src=\"../../storage/emotions/$image->image\" alt=\"\" width=\"50px\" height=\"50px\"> ";
            }
        }
        return $output;
    }
    public function getmoreMsg(Request $request){
        $roomid = $request->roomid;
        $offset = $request->offset;

        //get list
        $messages = DB::table('messenges')
            ->join('users','users.id','=','messenges.user_id')
            ->where('messenges.room_id', $roomid)
            ->select('users.avatar','users.name','users.fullname', 'messenges.*')
            ->offset($offset)
            ->take(10)
            ->orderBy('messenges.id','DESC')
            ->get();
        $listMsg = new Collection();
        for ($i = $messages->count()-1 ; $i >= 0 ; $i--){
            $listMsg->push($messages[$i]);
        }
        foreach ($listMsg as $key => $chat){
            $chat->content = self::getNewContent($chat->content);
        }
        $stringData = "";
        if($listMsg->count() > 0) {
            foreach ($listMsg as $msg) {
                if($msg->status ==0){
                    $stringData = $stringData . "<div style=\"padding-left: 30px;\"><h6><em style=\"color: #cccccc;\">"
												.$msg->content."</em></h6></div>";

                }else{
                    $stringData = $stringData . "<div class=\"lv-item media";
                    $msg->user_id == Auth::id() ? $stringData = $stringData . " right" : $stringData = $stringData . " left";
                    $stringData = $stringData . "\"><div class=\"lv-avatar";
                    $msg->user_id == Auth::id() ? $stringData = $stringData . " pull-right" : $stringData = $stringData . " pull-left";
                    $stringData = $stringData . "\"><img src=\"../../storage/avatars/".$msg->avatar."\" alt=\"\"></div><div class=\"media-body\">"
                                              ."<div class=\"ms-item\">"
												.$msg->content
											."</div>"
											."<small class=\"ms-date\">";
                    if($msg->name != Auth::user()->name) {
                        $stringData = $stringData . "<a href=\"/chat/".$msg->name . "\">"
                            . "<strong style=\"font-size: 10px\">" . $msg->fullname . "</strong>"
                            . "</a>";
                        if ($msg->user_id == Auth::user()->id) {
                            $stringData = $stringData . "-<strong style=\"color: red;font-size: 10px\">[AD]</strong>";
                        }
                    }
					$stringData = $stringData . "<span class=\"glyphicon glyphicon-time\"></span>"
												."&nbsp;".$msg->created_at
											."</small></div></div>";
                }
            }
            echo $stringData;
        }else{
            return 0;
        }
    }
}
