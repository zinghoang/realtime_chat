<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['name', 'room_id', 'type', 'title', ];

    public function room()
    {
    	return $this->belongsTo('App\Room');
    }
}
