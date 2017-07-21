<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class SearchUserController extends Controller
{
    public function index(Request $request)
    {
        $nameSeach = $request->search;
        if ($request->has('search')) {
            $users = User::search($nameSeach)
                ->paginate(12);
        } else {
            $users = User::paginate(12);
        }
        return view('frontend.search.users', compact('users', 'nameSeach'));
    }
}
