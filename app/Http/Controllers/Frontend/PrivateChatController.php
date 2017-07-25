<?php

namespace App\Http\Controllers\Frontend;

use App\Emotion;
use App\FriendShip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\PrivateMessage;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Integer;

class PrivateChatController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
	{
        $ids = PrivateMessage::where('from','=',Auth::user()->id)
            ->orderBy('created_at','DESC')
            ->select('to')->get();
        $arr_id = array();
        foreach ($ids as $id){
            array_push($arr_id,$id->to);
        }
        $arr_id = array_unique($arr_id);
        $users = new Collection();
        foreach ($arr_id as $id){
            $user = User::findOrFail($id);
            $users->push($user);
        }
        foreach ($users as $user){
            $check = self::checkFriendship($user->id);
            if($check != null){
                $user->friend = 1;
                $user->status = $check->status;
                $user->user_request = $check->user_request;
            }else{
                $user->friend = 0;
            }
        }
		return view('frontend.privatechat.index')->with('users',$users);
	}
    public function user($username)
    {
    	$user = Auth::user();
    	$toUser = User::where('name',$username)->first();
        if ($toUser == null) {
            abort(404);
        }

        if($toUser->name == $user->name){
            return redirect()->route('account.edit', $user->id);
        }
        $friendship = FriendShip::where('user_request','=',$user->id)
            ->where('user_accept','=',$toUser->id)
            ->orWhere('user_request','=',$toUser->id)
            ->where('user_accept','=',$user->id)
            ->first();

        $listPrivateChat = PrivateMessage::where('from', $user->id)->where('to', $toUser->id)->orWhere('from', $toUser->id)->where('to', $user->id)->get();
        foreach ($listPrivateChat as $key => $chat){
            $chat->content = self::getNewContent($chat->content);
        }

        return view('frontend.privatechat.user',compact('user','toUser', 'listPrivateChat','friendship'));
    }

    public function addPrivateMess(Request $request){
    	\Log::info($request);
    	$privateMessage = new PrivateMessage();
    	$privateMessage->from = $request['user']['id'];
    	$privateMessage->to = $request['toUser']['id'];
    	$privateMessage->content = $request['message'];
    	$privateMessage->save();
    	$privateMessage->content = self::getNewContent($privateMessage->content);
    	return $privateMessage;
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
                $output = $output. " "."<img src=\"../storage/emotions/$image->image\" alt=\"\" width=\"50px\" height=\"50px\"> ";
            }
            $image = null;
        }
        return $output;
    }
    public function requestRelationship($to){
        $from = Auth::user()->id;
        $friendship = new FriendShip();
        $friendship->user_request = $from;
        $friendship->user_accept = $to;
        $friendship->status = 0;
        $friendship->save();
        return redirect()->back();
    }
    public function deleteRelationship($id){
        $friendship = FriendShip::findOrFail($id);
        $friendship->delete();
        return redirect()->back();
    }
    public function acceptRelationship(Request $request,$id){
        $friendship = FriendShip::findOrFail($id);
        $friendship->status = 1;
        $friendship->save();
        $request->session()->flash('accept','You accepted the request! Let\'s send the first message');
        return redirect()->back();
    }
    public static function checkFriendship($id){
        return FriendShip::where('user_request','=',$id)
                                ->where('user_accept','=',Auth::user()->id)
                                ->orWhere('user_request','=',Auth::user()->id)
                                ->where('user_accept','=',$id)
                                ->select('status','user_request')
                                ->first();
    }
}
 