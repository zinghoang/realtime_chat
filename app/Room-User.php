<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomUser extends Model
{
	protected $table = 'room-_users';
	
    protected $fillable = ['user_id', 'room_id', ];
}
