<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    function room(){
        return $this->belongsTo(Room::class, "room_id");
    }
}
