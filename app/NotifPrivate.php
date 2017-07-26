<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotifPrivate extends Model
{
    protected $table = 'notifprivate';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'from', 'to','status' ];
}
