<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function index()
    {
        return view('');
    }

    public function create()
    {
    	return view('');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('backend.emotions.show');
    }

    public function invite($id)
    {
    	//
    }

    public function edit($id)
    {
        return view('backend.emotions.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
