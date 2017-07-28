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
    	$messages = DB::table('messenges')
            ->join('users','users.id','=','messenges.user_id')
            ->where('messenges.room_id', $id)
            ->select('users.avatar','users.name','users.fullname', 'messenges.*')
            ->take(100)
            ->orderBy('messenges.id','ASC')
            ->get();
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
        $nameFileSave = $request->file('title')->getClientOriginalName();
        $ar_name_file = explode('.', $nameFileSave);
        $formatFile = end($ar_name_file);

        //check file
        if ($formatFile != 'mp4' && $formatFile != 'avi' && $formatFile != 'mp3' && $formatFile != 'mpga' && $formatFile != 'mpeg') {
            
            $request->session()->flash('danger', 'The title must be a file of type: mp4, avi, mp3.');
            
            return redirect()->route('frontend.message.room', $id);
        }

        //Save file
        $name = $request->file('title')->store('public/media');
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
        $file->title = $nameFileSave;
        $file->user_id = Auth::id();
        $file->save();

        $message = new Messenges;
        $message->user_id = Auth::user()->id;
        $message->room_id = $id;
        $message->content = Auth::user()->name . ' has uploaded file: ' . $nameFileSave;
        $message->status = 0;
        $message->save();

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
        
        //Xoa record trong CSDL
        $file->delete();

        //add message
        $message = new Messenges;
        $message->user_id = Auth::user()->id;
        $message->room_id = $file->room_id;
        $message->content = Auth::user()->name . ' has deleted file: ' . $file->title;
        $message->status = 0;
        $message->save();

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
        //1- gui thong bao den cac thanh vien trong room
            $user_ids = RoomUser::where('room_id','=',$request['room']['id'])
                                    ->where('user_id','!=',Auth::user()->id)
                                    ->select('user_id')->get();
            foreach ($user_ids as $user_id){
                $notifRoom = NotifRoom::where('roomid','=',$request['room']['id'])
                                        ->where('userid','=',$user_id->user_id)
                                        ->first();
                if($notifRoom == null){
                    $notifRoom = new NotifRoom;
                    $notifRoom->roomid = $request['room']['id'];
                    $notifRoom->userid = $user_id->user_id;
                    $notifRoom->status = 0;
                    $notifRoom->save();
                }
            }
        //end -1
        $message->content = self::getNewContent($message->content);
        $avatar = User::where('id','=',$message->user_id)->select('avatar')->first();
        $message->avatar = $avatar->avatar;
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
}
