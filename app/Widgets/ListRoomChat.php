<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Room;
use Auth;
use DB;
class ListRoomChat extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //get listroom user has join
        $roomJoined = DB::table('rooms')->join('room_users','rooms.id','=','room_users.room_id')->where('room_users.user_id','=',Auth::user()->id)
        ->select('rooms.id','rooms.name','room_users.user_id')
        ->get();


        return view('frontend.layouts.widgets.list_room_chat', [
            'config' => $this->config,
            'listRoom' => $roomJoined,
            'roomJoined' =>$roomJoined
        ]);
    }
}
