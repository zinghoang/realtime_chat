<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class SearchUserController extends Controller
{
    public function index(Request $request)
    {
        $nameSeach = $request->search;

        $users = User::whereRaw('fullname LIKE "%'.$nameSeach.'%"')
            ->where('name','!=',Auth::user()->name)->paginate(5);
        return view('frontend.search.users', compact('users', 'nameSeach'));
    }
}
