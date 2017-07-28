<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CheckAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = User::orderBy('id','DESC')->paginate(15);
        return view('backend.users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->fullname = $request->fullname;
        $user->level = $request->level;
        $user->avatar = 'avatar.png';

        if($user->save()) {
            $request->session()->flash('success', 'User was created successful');
        }else{
            $request->session()->flash('fail', 'User was created unsuccessful');
        }
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.show')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.edit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);

        //Lay thong tin tu form
        $user->name = $request->name;
        $user->email = $request->email;
        $user->fullname = $request->fullname;
        $user->level = $request->level;

        if($request->password != null){
            $user->password = bcrypt($request->password);
        }

        if($request->file('avatar') != null){

            if($user->avatar != 'avatar.png'){
                //Xoa anh cu~
                File::delete('storage/avatars/'.$user->avatar);
            }
            //Up anh moi
            $image = $request->file('avatar')->store('public/avatars');
            $arr_filename = explode("/",$image);
            $filename = end($arr_filename);
        }else{
            $filename = $user->avatar;
        }

        $user->avatar = $filename;

        if($user->save()) {
            $request->session()->flash('success', 'User was updated successful');
        }else{
            $request->session()->flash('fail', 'User was updated unsuccessful');
        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        Room::where('user_id', $id)->delete();

        if($user->avatar != 'avatar.png'){
            //Xoa anh trong folder
            File::delete('storage/avatars/'.$user->avatar);
        }

        //Xoa record trong database
        $user->delete();
        return redirect()->route('users.index');
    }
    

}
