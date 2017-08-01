<?php

namespace App\Widgets;

use App\NotifPrivate;
use App\PrivateMessage;
use Arrilot\Widgets\AbstractWidget;

use App\User;
use Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


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
        $arr_idLoad = array_slice($arr_id,0,3);
        $users = new Collection();
        foreach ($arr_idLoad as $id){
            $user = User::findOrFail($id);
            //kiem tra user co thong bao hay khong
            $status = DB::table('notifprivate')
                ->join('users','users.id','=','notifprivate.from')
                ->where('notifprivate.from','=',$user->id)
                ->where('notifprivate.to','=',Auth::user()->id)->first();
            if($status != null){
                $user->notif = 1;
            }else{
                $user->notif = 0;
            }
            $users->push($user);
        }
        //dem thong bao chua xem
        $notif = 0;
        if(count($arr_id) > 0){
            $arr_notif = array_slice($arr_id,3,count($arr_id)-3);
            foreach ($arr_notif as $fromUser) {
                $checkNotif = NotifPrivate::where('from', '=', $fromUser)
                    ->where('to', '=', Auth::user()->id)
                    ->first();
                if ($checkNotif != null){
                    $notif++;
                }
            }
        }
        return view('frontend.layouts.widgets.list_user_chat', [
            'config' => $this->config,
            'listUser' => $users,
            'notif' => $notif
        ]);
    }
}
