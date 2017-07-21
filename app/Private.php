<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Private extends Model
{
	use Searchable;

	protected $table = 'privates';
	
    protected $fillable = ['from', 'to', 'content', ];

    public function searchableAs()
    {
        return 'privates_index';
    }
}
