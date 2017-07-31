<?php

namespace App\Http\Controllers\BackEnd;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Room;
use App\File;
use Illuminate\Support\Facades\DB;
use App\Emotion;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CheckAdmin');
    }

    public function index()
    {
        $countRooms = Room::count();
        $countFiles = File::count();
        $countEmotions = Emotion::count();
        
        $countUsers = User::where('level', 0)->count();
        $countAdmins = User::where('level', 1)->count();
        $countSuperAdmins = User::where('level', 2)->count();

        $userRecents = User::where('level', 0)->orderBy('id', 'desc')->take(4)->get();
        $bigRoom = DB::table('rooms')
            ->join('room_users', 'room_id', '=', 'rooms.id')
            ->groupBy('room_id')
            ->select(DB::raw('count(*) as soLuong'), 'rooms.name', 'rooms.id')
            ->orderBy('soLuong', 'desc')
            ->take(5)
            ->get();
        
        return view('backend.home.index', compact('countRooms', 'countFiles', 'countEmotions', 'countUsers', 'countAdmins', 'countSuperAdmins', 'userRecents', 'bigRoom'));
    }


}
