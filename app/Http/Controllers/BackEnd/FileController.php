<?php

namespace App\Http\Controllers\BackEnd;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = DB::table('files')
            ->join('users','users.id','=','files.user_id')
            ->join('rooms','rooms.id','=','files.room_id')
            ->select('files.id','files.title','files.type','users.fullname','rooms.name as roomname')
            ->paginate(1);

        return view('backend.files.index')->with('files',$files);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = DB::table('files')
            ->join('users','users.id','=','files.user_id')
            ->join('rooms','rooms.id','=','files.room_id')
            ->where('files.id','=',$id)
            ->select('files.*','users.fullname','rooms.name as roomname')
            ->get();

        return view('backend.files.show')->with('file',$file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.files.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $file = File::findOrFail($id);
        //Xoa file
        \Illuminate\Support\Facades\File::delete('storage/media/'.$file->name);
        //Xoa record trong CSDL
        $file->delete();
        $request->session()->flash('success','Removed Successful');
        return redirect()->route("files.index");
    }
}
