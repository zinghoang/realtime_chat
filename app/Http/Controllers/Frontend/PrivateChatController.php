<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Private;

class PrivateChatController extends Controller
{
	public function index()
	{
		return view('frontend.privatechat.index');
	}
    public function user($username)
    {	
    	$user = Auth::user();
    	$toUser = User::where('name',$username)->first();
    	return view('frontend.privatechat.user',compact('user','toUser'));
    }

    public function addPrivateMess(Request $request){
    	\Log::info($request);
    	Private::create([
    		'from' => $request['user']['id'],
    		'to' =>$request['toUser']['id'],
    		'content' => $request['message']
    		])
    }
}
 