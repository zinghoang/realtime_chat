<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Private extends Model
{
	protected $table = 'privates';
	
    protected $fillable = ['from', 'to', 'content', ];
}
