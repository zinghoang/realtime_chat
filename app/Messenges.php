<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messenges extends Model
{
    protected $fillable = ['user_id', 'room_id', 'content', 'date', ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function room()
    {
    	return $this->belongsTo('App\Room');
    }
}
