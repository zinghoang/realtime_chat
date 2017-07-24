<?php

namespace App\Http\Controllers\Frontend;

use App\Emotion;
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
    	$room = Room::findOrFail($id);

    	$checkJoin = RoomUser::where('user_id', Auth::id())->where('room_id', $id)->first();
    	if($checkJoin == null){
    		$isJoin = 0;
    	}else{
    		$isJoin = 1;
    	}
    	$messages = DB::table('messenges')
                ->join('users','users.id','=','messenges.user_id')
                ->select('users.avatar', 'messenges.*')
                ->take(100)
                ->orderBy('messenges.id','ASC')
                ->get();
        foreach ($messages as $key => $chat){
            $chat->content = self::getNewContent($chat->content);
        }
        $listFile = File::where('room_id', $id)->get();
    	return view('frontend.messenges.room', compact('isJoin', 'room','messages','listFile'));
    }

    public function uploadFile(FileRequest $request, $id)
    {

        $checkJoin = RoomUser::where('user_id', Auth::id())->where('room_id', $id)->first();

        if($checkJoin == null){
            return redirect()->route('frontend.message.room', $id);
        }

        $name = $request->file('title')->store('public/media');
        $ar_name = explode('/', $name);
        $nameFile = end($ar_name);

        $fileType = explode('.', $nameFile);
        $formatFile = end($fileType);

        if ($formatFile === 'mp4' || $formatFile === 'avi') {
            $type = 'video';
        }elseif ($formatFile === 'mp3') {
            $type = 'sound';
        }else{
            $type = 'nas';
        }

        $file = new File();
        $file->room_id = $id;
        $file->name = $nameFile;
        $file->type = $type;
        $file->title = $request->file('title')->getClientOriginalName();
        $file->user_id = Auth::id();



        $file->save();

        return redirect()->route('frontend.message.room', $id);
    }
        
    public function addRoomMessage(Request $request){
     //   \Log::info($request);
        $message = new Messenges();
        $message->user_id = $request['user']['id'];
        $message->room_id = $request['room']['id'];
        $message->content = $request['message'];
        $message->status = true;
        $message->save();

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
            $image = null;
        }
        return $output;
    }
}
