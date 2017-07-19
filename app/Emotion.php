<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emotion extends Model
{
    protected $fillable = ['name', 'image', 'code', ];
}
