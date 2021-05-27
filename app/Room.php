<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    function session(){
        return $this->hasMany(Session::class, "room_id");
    }

    function channel(){
        return $this->belongsTo(Channel::class, "channel_id");
    }
}
