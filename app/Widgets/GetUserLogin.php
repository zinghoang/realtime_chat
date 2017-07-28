<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

use Auth;

class GetUserLogin extends AbstractWidget
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

        return view('frontend.layouts.widgets.get_user_login', [
            'config' => $this->config,
            'user' => Auth::user(),
        ]);
    }
}
