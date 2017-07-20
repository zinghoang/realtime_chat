<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivateChatController extends Controller
{
    public function user($username)
    {
    	return view('frontend.privatechat.user');
    }
}
 