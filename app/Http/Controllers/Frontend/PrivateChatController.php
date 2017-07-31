<?php

namespace App\Http\Controllers\Frontend;

use App\Emotion;
use App\FriendShip;
use App\NotifPrivate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\PrivateMessage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class PrivateChatController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
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
        $users = new Collection();
        foreach ($arr_id as $id){
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
		return view('frontend.privatechat.index')->with('users',$users);
	}
    public function user($username)
    {
        $userid = User::where('name','=',$username)->select('id')->first();

        //xoa thong bao tu user nay neu co
        $notif = NotifPrivate::where('from','=',$userid->id)
                                ->where('to','=',Auth::user()->id)
                                ->first();
        if($notif!= null){
            $notif->delete();
        }
    	$user = Auth::user();
    	$toUser = User::where('name',$username)->first();
        if ($toUser == null) {
            abort(404);
        }

        if($toUser->name == $user->name){
            return redirect()->route('account.edit', $user->id);
        }
        $friendship = FriendShip::where('user_request','=',$user->id)
            ->where('user_accept','=',$toUser->id)
            ->orWhere('user_request','=',$toUser->id)
            ->where('user_accept','=',$user->id)
            ->first();

        $listFirst = PrivateMessage::where('from', $user->id)
            ->where('to', $toUser->id)
            ->orWhere('from', $toUser->id)
            ->where('to', $user->id)
            ->orderBy('id','DESC')
            ->offset(0)
            ->take(10)
            ->get();
        $listPrivateChat = new Collection();
        for ($i = $listFirst->count()-1 ; $i >= 0 ; $i--){
            $listPrivateChat->push($listFirst[$i]);
        }
        foreach ($listPrivateChat as $key => $chat){
            $chat->content = self::getNewContent($chat->content);
        }

        return view('frontend.privatechat.user',compact('user','toUser', 'listPrivateChat','friendship'));
    }

    public function addPrivateMess(Request $request){
    	\Log::info($request);
    	$privateMessage = new PrivateMessage();
    	$privateMessage->from = $request['user']['id'];
    	$privateMessage->to = $request['toUser']['id'];
    	$privateMessage->content = $request['message'];
    	$privateMessage->save();
    	$privateMessage->content = self::getNewContent($privateMessage->content);

    	//xóa thông báo từ bạn chat nếu có
        $notif = NotifPrivate::where('from','=',$request['toUser']['id'])
                                ->where('to','=',$request['user']['id'])
                                ->first();
        if($notif != null){
            $notif->delete();
        }
    	//luu thong bao
        $notifprivate = NotifPrivate::where('from','=',$request['user']['id'])
            ->where('to','=',$request['toUser']['id'])->first();
        if($notifprivate == null ){
            $notifprivate = new NotifPrivate();
            $notifprivate->from = $request['user']['id'];
            $notifprivate->to = $request['toUser']['id'];
            $notifprivate->status = 0;
            $notifprivate->save();
        }
        $privateMessage->notif = $notifprivate;


        //cap nhat list lien lac gan day
        $ids = PrivateMessage::where('from','=',$request['toUser']['id'])
            ->orWhere('to','=',$request['toUser']['id'])
            ->orderBy('created_at','DESC')
            ->select('from','to')->get();
        $arr_id = array();
        foreach ($ids as $id){
            if($request['toUser']['id'] == $id->to){
                array_push($arr_id,$id->from);
            }else{
                array_push($arr_id,$id->to);
            }
        }
        $arr_id = array_unique($arr_id);
        $del_key = array_search($request['toUser']['id'], $arr_id);
        if($del_key !== false){
            unset($arr_id[$del_key]);
        }
        $arr_id = array_slice($arr_id,0,5);
        $users = new Collection();
        foreach ($arr_id as $id){
            $user = User::findOrFail($id);
            //kiem tra user co thong bao hay khong
            $status = DB::table('notifprivate')
                        ->join('users','users.id','=','notifprivate.from')
                        ->where('notifprivate.from','=',$user->id)->first();
            if($status != null){
                $user->notif = 1;
            }else{
                $user->notif = 0;
            }
            $users->push($user);
        }
        $privateMessage->listUser = $users;

        //cap nhat list lien lac gan day cua user gui~
        $ids = PrivateMessage::where('from','=',$request['user']['id'])
            ->orWhere('to','=',$request['user']['id'])
            ->orderBy('created_at','DESC')
            ->select('from','to')->get();
        $arr_id = array();
        foreach ($ids as $id){
            if($request['user']['id'] == $id->to){
                array_push($arr_id,$id->from);
            }else{
                array_push($arr_id,$id->to);
            }
        }
        $arr_id = array_unique($arr_id);
        $del_key = array_search($request['user']['id'], $arr_id);
        if($del_key !== false){
            unset($arr_id[$del_key]);
        }
        $arr_id = array_slice($arr_id,0,5);
        $users = new Collection();
        foreach ($arr_id as $id){
            $user = User::findOrFail($id);
            //kiem tra user co thong bao hay khong
            $status = DB::table('notifprivate')
                ->join('users','users.id','=','notifprivate.from')
                ->where('notifprivate.from','=',$user->id)->first();
            $status != null ? $user->notif = 1 : $user->notif = 0;
            $users->push($user);
        }
        $privateMessage->listUserFrom = $users;
    	return $privateMessage;
    }
    public static function getNewContent($content)
    {
        $output = "";
        $arr_text = explode(" ",$content);
        foreach ($arr_text as $str){
            $code = $str;
            $image = Emotion::where('code','=',$code)
                ->select('image')->first();
            if($image == null){
                $output = $output. " ".$code;
            }else{
                $output = $output. " "."<img src=\"../storage/emotions/$image->image\" alt=\"\" width=\"50px\" height=\"50px\"> ";
            }
            $image = null;
        }
        return $output;
    }
    public function requestRelationship($to){
        $from = Auth::user()->id;
        $friendship = new FriendShip();
        $friendship->user_request = $from;
        $friendship->user_accept = $to;
        $friendship->status = 0;
        $friendship->save();
        return redirect()->back();
    }
    public function deleteRelationship($id){
        $friendship = FriendShip::findOrFail($id);
        $friendship->delete();
        return redirect()->back();
    }
    public function acceptRelationship(Request $request,$id){
        $friendship = FriendShip::findOrFail($id);
        $friendship->status = 1;
        $friendship->save();
        $request->session()->flash('accept','You accepted the request! Let\'s send the first message');
        return redirect()->back();
    }
    public static function checkFriendship($id){
        return FriendShip::where('user_request','=',$id)
                                ->where('user_accept','=',Auth::user()->id)
                                ->orWhere('user_request','=',Auth::user()->id)
                                ->where('user_accept','=',$id)
                                ->select('status','user_request')
                                ->first();
    }
    public function deleteNotif(Request $request){
        $from = $request->userfrom;
        $to = $request->userto;
        $notif = NotifPrivate::where('from','=',$from)
                                ->where('to','=',$to)
                                ->first();
        if($notif != null){
            $delete = NotifPrivate::findOrFail($notif->id);
            $delete->delete();
        }
    }
    public function getmoreMsg(Request $request){
        $from = $request->from;
        $to = $request->to;
        $offset = $request->offset;

        //get list
        $listFirst = PrivateMessage::where('from','=',$from)
            ->where('to','=',$to)
            ->orWhere('from','=',$to)
            ->where('to','=',$from)
            ->offset($offset)
            ->take(10)
            ->orderBy('id','DESC')
            ->get();
        $listMsg = new Collection();
        for ($i = $listFirst->count()-1 ; $i >= 0 ; $i--){
            $listMsg->push($listFirst[$i]);
        }
        foreach ($listMsg as $key => $chat){
            $chat->content = self::getNewContent($chat->content);
        }
        //Get User Information
        $userFrom = User::findOrFail($from);
        $userTo = User::findOrFail($to);
        if($userFrom == null || $userTo == null){
            abort(404);
        }
        $stringDivData = '';
        if($listMsg->count() > 0){
            foreach( $listMsg as $msg ){
                $stringDivData = $stringDivData . '<div class="lv-item media';
                if($msg->from == Auth::user()->id) $stringDivData = $stringDivData .' right';
                $stringDivData = $stringDivData . ' "><div class="lv-avatar ';
                $msg->from == Auth::user()->id ? $stringDivData = $stringDivData .'pull-right ">' : $stringDivData = $stringDivData .'pull-left ">';
                if($chat->from == $from) {
                    $stringDivData = $stringDivData .'<img src = "../storage/avatars/'.$userFrom->avatar.'" alt = "" >';
                }else if($msg->from == $to) {
                    $stringDivData = $stringDivData .'<img src = "../storage/avatars/'.$userTo->avatar.'" alt = "" >';
                }

                $stringDivData = $stringDivData .' </div><div class="media-body"><div class="ms-item">'
                                    .$msg->content.'</div><small class="ms-date"><span class="glyphicon glyphicon-time"></span>'
                                    .'&nbsp;' . $msg->created_at
                                    .'</small></div></div>';
            }
            echo $stringDivData;
        }else{
            return 0;
        }

    }
}
 