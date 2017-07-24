<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class File extends Model
{
    protected $fillable = ['name', 'room_id', 'type', 'title', ];

    use Searchable;
    
    public function searchableAs()
    {
        return 'files_index';
    }

    public function room()
    {
    	return $this->belongsTo('App\Room');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
