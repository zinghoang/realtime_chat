<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Messenges extends Model
{
	use Searchable;

    protected $fillable = ['user_id', 'room_id', 'content', 'date', ];

    public function searchableAs()
    {
        return 'messengeses_index';
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function room()
    {
    	return $this->belongsTo('App\Room');
    }
}
