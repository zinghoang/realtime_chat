<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

use App\Room;
use App\RoomUser;
use Auth;

class MessageRoom extends AbstractWidget
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
    public function run($id)
    {
        $room = Room::findOrFail($id);

        $checkJoin = RoomUser::where('user_id', Auth::id())->where('room_id', $id)->first();
        if($checkJoin == null){
            $isJoin = 0;
        }else{
            $isJoin = 1;
        }

        $listMemberOrRoom = RoomUser::where('room_id', $id)->get()->toArray();
        $countMember = count($listMemberOrRoom);

        return view('frontend.layouts.widgets.message_room', [
            'config' => $this->config,
            'room' => $room,
            'isJoin' => $isJoin,
            'countMember' => $countMember
        ]);
    }
}
