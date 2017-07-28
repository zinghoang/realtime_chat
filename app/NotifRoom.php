<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotifRoom extends Model
{
    protected $table = 'notifroom';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'roomid', 'userid','status' ];
}
