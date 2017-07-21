<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Room extends Model
{
    use Searchable;

    protected $fillable = ['name'];

    public function searchableAs()
    {
        return 'rooms_index';
    }

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
}
