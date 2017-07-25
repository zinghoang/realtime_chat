<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendShip extends Model
{
    protected $table = 'friendship';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'user_request', 'user_accept','status' ];
}
