<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Private;

class SearchPrivateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $privates = Private::search($request->search)
                ->paginate(6);
        } else {
            $privates = Private::paginate(6);
        }
        return view('', compact(''));
    }
}
