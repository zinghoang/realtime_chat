<?php

namespace App\Http\Controllers\Frontend;


use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

class AccountController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if($id != Auth::user()->id){
            $request->session()->flash('fail','You must not to access to another\'s profile!');
            return redirect()->route('account.edit',Auth::user()->id);
        }else{
            return view('frontend.account.profile');
        }
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
        if($id != Auth::user()->id){
            $request->session()->flash('fail','You must not to access to another\'s profile!');
        }else{
            $user = User::findOrFail($id);
            //Lay thong tin tu form
            $user->name = $request->name;
            $user->email = $request->email;
            $user->fullname = $request->fullname;
            if($request->email != null){
                $user->password = bcrypt($request->password);
            }
            if($request->file('avatar') != null){
                $image = Input::file('avatar')->getClientOriginalName();
                if($user->avatar != 'avatar.png'){
                    //Xoa anh cu~
                    File::delete('storage/avatars/'.$user->avatar);
                }
                //Up anh moi
                Input::file('avatar')->move('storage/avatars', $image);
            }else{
                $image = $user->avatar;
            }
            $user->avatar = $image;
            if($user->save()) {
                $request->session()->flash('success', 'Your profile was updated successful');
            }else{
                $request->session()->flash('fail', 'Your profile was updated unsuccessful');
            }
            return redirect()->route('account.edit',Auth::user()->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
