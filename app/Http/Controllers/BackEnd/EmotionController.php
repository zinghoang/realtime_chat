<?php

namespace App\Http\Controllers\BackEnd;

use App\Emotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class EmotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emotions = Emotion::paginate(10);
        return view('backend.emotions.index')->with('emotions',$emotions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.emotions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code = $request->code;
        $emotion = Emotion::where('code','=',$code)->first();
        if($emotion == null){
            $name = $request->name;
            $image = Input::file('image')->getClientOriginalName();
            Input::file('image')->move('storage/emotions', $image);
            $emotion_add = new Emotion();
            $emotion_add->name = $name;
            $emotion_add->code = $code;
            $emotion_add->image = $image;
            $emotion_add->save();
            $request->session()->flash('addsuccess','Emotion was added success!');
        }else{
            $request->session()->flash('addfail','The code was existed!');
        }
        return redirect()->route('emotions.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emotion = Emotion::findOrFail($id);
        return view('backend.emotions.show')->with('emotion',$emotion);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.emotions.edit');
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
    public function destroy($id)
    {
        //
    }
}
