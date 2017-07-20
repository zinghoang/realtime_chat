<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessengesController extends Controller
{
    public function room($id)
    {
    	return view('frontend.messenges.room');
    }
}
