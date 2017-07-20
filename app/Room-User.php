<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomUser extends Model
{
	protected $table = 'room_users';
	
    protected $fillable = ['user_id', 'room_id', ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function room()
    {
    	return $this->belongsTo('App\Room');
    }
}
