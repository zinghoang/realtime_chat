<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\PrivateMessage;

class PrivateChatController extends Controller
{
	public function index()
	{
		return view('frontend.privatechat.index');
	}
    public function user($username)
    {	
    	$user = Auth::user();
    	$toUser = User::where('name',$username)->where('name', '!=', $user->name)->first();

        if ($toUser == null) {
            abort(404);
        }

        $listPrivateChat = PrivateMessage::where('from', $user->id)->where('to', $toUser->id)->orWhere('from', $toUser->id)->where('to', $user->id)->get();
        
    	return view('frontend.privatechat.user',compact('user','toUser', 'listPrivateChat'));
    }

    public function addPrivateMess(Request $request){
    	\Log::info($request);
    	return PrivateMessage::create([
    		'from' => $request['user']['id'],
    		'to' =>$request['toUser']['id'],
    		'content' => $request['message']
    		]);
    }
}
 