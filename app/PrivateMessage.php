<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class PrivateMessage extends Model
{
	protected $table = 'privates';
	
    protected $fillable = ['from', 'to', 'content', ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
