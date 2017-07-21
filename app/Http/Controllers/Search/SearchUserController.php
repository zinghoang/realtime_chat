<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class SearchUserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $users = User::search($request->search)
                ->paginate(6);
        } else {
            $users = User::paginate(6);
        }
        return view('frontend.search.searchusers', compact('users'));
    }
}
