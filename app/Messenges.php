<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messenges extends Model
{
    protected $fillable = ['user_id', 'room_id', 'content', 'date', ];
}
