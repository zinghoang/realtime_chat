<?php

namespace App\Widgets;

use App\PrivateMessage;
use Arrilot\Widgets\AbstractWidget;

use App\User;
use Auth;
use Illuminate\Support\Collection;


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

        $ids = PrivateMessage::where('from','=',Auth::user()->id)
            ->orWhere('to','=',Auth::user()->id)
            ->orderBy('created_at','DESC')
            ->select('from','to')->get();
        $arr_id = array();
        foreach ($ids as $id){
            if(Auth::user()->id == $id->to){
                array_push($arr_id,$id->from);
            }else{
                array_push($arr_id,$id->to);
            }
        }
        $arr_id = array_unique($arr_id);
        $del_key = array_search(Auth::user()->id, $arr_id);
        if($del_key !== false){
            unset($arr_id[$del_key]);
        }
        $arr_id = array_slice($arr_id,0,3);
        $users = new Collection();
        foreach ($arr_id as $id){
            $user = User::findOrFail($id);
            $users->push($user);
        }
        return view('frontend.layouts.widgets.list_user_chat', [
            'config' => $this->config,
            'listUser' => $users,
            
        ]);
    }
}
