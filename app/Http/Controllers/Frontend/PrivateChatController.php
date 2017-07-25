<?php

namespace App\Http\Controllers\Frontend;

use App\Emotion;
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
    	$toUser = User::where('name',$username)->first();
        if ($toUser == null) {
            abort(404);
        }

        if($toUser->name == $user->name){
            return redirect()->route('account.edit', $user->id);
        }

        $listPrivateChat = PrivateMessage::where('from', $user->id)->where('to', $toUser->id)->orWhere('from', $toUser->id)->where('to', $user->id)->get();
        foreach ($listPrivateChat as $key => $chat){
            $chat->content = self::getNewContent($chat->content);
        }
        return view('frontend.privatechat.user',compact('user','toUser', 'listPrivateChat'));
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
}
 