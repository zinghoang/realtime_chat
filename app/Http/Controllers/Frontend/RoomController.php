<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function index()
    {
        return view('frontend.rooms.index');
    }

    public function create()
    {
    	return view('frontend.rooms.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('frontend.rooms.show');
    }

    public function invite($id)
    {
    	//
    }

    public function edit($id)
    {
        return view('frontend.rooms.edit');
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
