<?php

namespace App\Http\Controllers\Frontend;

use App\Emotion;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RoomUser;
use App\Room;
use Auth;
use App\Messenges;
use Illuminate\Support\Facades\DB;

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
    	return view('frontend.messenges.room', compact('isJoin', 'room','messages'));
    }

    public function addRoomMessage(Request $request){
        \Log::info($request);
        $message = new Messenges();
        $message->user_id = $request['user']['id'];
        $message->room_id = $request['room']['id'];
        $message->content = $request['message'];
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
