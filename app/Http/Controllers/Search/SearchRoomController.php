<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;

class SearchRoomController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $rooms = Room::search($request->search)
                ->paginate(6);
        } else {
            $rooms = Room::paginate(6);
        }
        return view('', compact(''));
    }
}
