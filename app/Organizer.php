<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    function event(){
        return $this->hasMany(Event::class, "organizer_id");
    }
}
