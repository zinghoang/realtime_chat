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

class PrivateChatController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
	{
	    $user_ids = PrivateMessage::distinct()->select('to')
                ->where('from','=',Auth::user()->id)
                ->get();
	    $users = new Collection();
	    if(count($user_ids) > 0){
            foreach ($user_ids as $user_id){
                $user = User::findOrFail($user_id)->first();
                $users->push($user);
            }
        }
		return view('frontend.privatechat.index')->with('users',$users);
	}
    public function user($username)
    {	
    	$user = Auth::user();
    	$toUser = User::where('name',$username)->where('name', '!=', $user->name)->first();
        if ($toUser == null) {
            abort(404);
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

        $username = User::findOrFail($to);
        return redirect()->route('private.user',$username->name);
    }
    public function deleteRelationship($id){
        $friendship = FriendShip::findOrFail($id);
        $friendship->delete();
        if(Auth::user()->id == $friendship->user_request){
            $user = User::findOrFail($friendship->user_accept);
        }else{
            $user = User::findOrFail($friendship->user_request);
        }
        return redirect()->route('private.user',$user->name);
    }
    public function acceptRelationship(Request $request,$id){
        $friendship = FriendShip::findOrFail($id);
        $friendship->status = 1;
        $friendship->save();
        $user = User::findOrFail($friendship->user_request);
        $request->session()->flash('accept','You accepted the request! Let\'s send the first message');
        return redirect()->route('private.user',$user->name);
    }
}
 