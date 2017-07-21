<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Messenges;

class SearchMessengesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $messengeses = Messenges::search($request->search)
                ->paginate(6);
        } else {
            $messengeses = Messenges::paginate(6);
        }
        return view('', compact(''));
    }
}
