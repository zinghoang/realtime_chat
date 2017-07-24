<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RoomUser;
use App\Room;
use App\File;
use Auth;
use App\Messenges;

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

        $listFile = File::where('room_id', $id)->get();

    	return view('frontend.messenges.room', compact('isJoin', 'room', 'listFile'));
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
        return Messenges::create([
            'user_id' => $request['user']['id'],
             'room_id' => $request['room']['id'], 
             'content' => $request['message'],
             'status' => true
        ]);
    }
}
