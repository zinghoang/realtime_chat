<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Emotion;

class EmotionChat extends AbstractWidget
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

        return view('frontend.layouts.widgets.emotion_chat', [
            'config' => $this->config,
            'listEmotion' => Emotion::all(),
        ]);
    }
}
