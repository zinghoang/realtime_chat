<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;

class SearchFileController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $files = File::search($request->search)
                ->paginate(6);
        } else {
            $files = File::paginate(6);
        }
        return view('', compact(''));
    }
}
