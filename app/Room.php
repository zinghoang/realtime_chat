<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name'];

    public function roomusers()
    {
    	return $this->hasMany('App\Room-User');
    }

    public function messengeses()
    {
    	return $this->hasMany('App\Messenges');
    }

    public function files()
    {
    	return $this->hasMany('App\File');
    }
}
