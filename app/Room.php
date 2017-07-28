<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Room extends Model
{
    protected $fillable = ['name'];

    public function roomusers()
    {
    	return $this->hasMany('App\RoomUser');
    }

    public function messengeses()
    {
    	return $this->hasMany('App\Messenges');
    }

    public function files()
    {
    	return $this->hasMany('App\File');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
