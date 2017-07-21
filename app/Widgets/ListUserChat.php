<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

use App\User;
use Auth;


class ListUserChat extends AbstractWidget
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

        return view('frontend.layouts.widgets.list_user_chat', [
            'config' => $this->config,
            'listUser' => User::where('id', '!=', Auth::id())->get(),
            
        ]);
    }
}
