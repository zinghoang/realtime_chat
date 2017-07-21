<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Room;

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
        //

        return view('frontend.layouts.widgets.list_room_chat', [
            'config' => $this->config,
            'listRoom' => Room::all(),
        ]);
    }
}
