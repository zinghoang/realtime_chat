<?php

namespace App\Http\Controllers\BackEnd;

use App\Emotion;
use App\Http\Requests\EmotionRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class EmotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emotions = Emotion::orderBy('id','DESC')->paginate(10);
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
    public function store(EmotionRequest $request)
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
            $request->session()->flash('success','Emotion was added success!');
        }else{
            $request->session()->flash('fail','The code was existed!');
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
        $emotion = Emotion::findOrFail($id);
        return view('backend.emotions.edit')->with('emotion',$emotion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmotionRequest $request, $id)
    {
        $emotion = Emotion::findOrFail($id);
        //Lay thong tin tu form
        $name = $request->name;
        $code = $request->code;
        //kiem tra code co bi trung khong
        $emotion_check_code = Emotion::where('code','=',$code)->first();
        if($emotion_check_code !=null && $emotion_check_code->id === $emotion->id){ //khong trung
            if($request->file('image') != null){
                $image = Input::file('image')->getClientOriginalName();
                //Xoa anh cu~
                File::delete('storage/emotions/'.$emotion->image);
                //Up anh moi
                Input::file('image')->move('storage/emotions', $image);
            }else{
                $image = $emotion->image;
            }
            $emotion->name = $name;
            $emotion->code = $code;
            $emotion->image = $image;
            $emotion->save();
            $request->session()->flash('success','The emotion was updated successful!');
        }else{ //trung
            $request->session()->flash('fail','The code was existed!');
        }
        return redirect()->route('emotions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emotion = Emotion::findOrFail($id);
        //Xoa file
        File::delete('storage/emotions/'.$emotion->image);
        //Xoa record trong CSDL
        $emotion->delete();
        return redirect()->route("emotions.index");
    }
}
