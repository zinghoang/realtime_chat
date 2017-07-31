<?php

namespace App\Widgets;

use App\NotifRoom;
use Arrilot\Widgets\AbstractWidget;
use App\Room;
use Auth;
use DB;
use Illuminate\Support\Collection;

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
        $listRoom = DB::table('rooms')
            ->join('room_users','rooms.id','=','room_users.room_id')
            ->join('messenges','rooms.id','=','messenges.room_id')
            ->where('room_users.user_id','=',Auth::user()->id)
            ->orderBy('messenges.created_at','DESC')
            ->select('rooms.id')->get();
        $arr_roomid = array();
        foreach ($listRoom as $room){
            array_push($arr_roomid,$room->id);
        }
        $arr_roomid = array_unique($arr_roomid);
        $listRoomJoined = new Collection();
        foreach ($arr_roomid as $roomid){
            $room = Room::findOrFail($roomid);
            if($room != null){
                $listRoomJoined->push($room);
            }
        }
        $arr_roomidLoad = array_slice($arr_roomid,0,3);
        $rooms = new Collection();
        foreach ($arr_roomidLoad as $roomid){
            $room = Room::findOrFail($roomid);
            if($room != null){
                $notifRoom = NotifRoom::where('roomid','=',$roomid)
                    ->where('userid','=',Auth::user()->id)
                    ->first();
                $notifRoom != null ? $room->notif = 1 : $room->notif = 0;
                $rooms->push($room);
            }
        }
        //kiem tra xem con thong bao nao nua~ hay khong
        $moreNotif = 0; //mac dinh la khong co
        if(count($arr_roomid) > 3){
            $arr_roomidUnload = array_slice($arr_roomid,3,count($arr_roomid)-3);
            //kiem tra nhung room con lai co thong bao hay khong
            foreach ($arr_roomidUnload as $roomid){
                $notif = NotifRoom::where('roomid','=',$roomid)
                                    ->where('userid','=',Auth::user()->id)
                                    ->first();
                if($notif != null){
                    $moreNotif++;
                }
            }
        }
        return view('frontend.layouts.widgets.list_room_chat', [
            'config' => $this->config,
            'listRoom' => $rooms,
            'roomJoined' =>$listRoomJoined,
            'moreNotif' => $moreNotif
        ]);
    }
}
