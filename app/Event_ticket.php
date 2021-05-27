<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_ticket extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    function registration(){
        return $this->hasMany(Registration::class, "ticket_id");
    }

    function special_validity(){
        $temp = json_decode($this->special_validity, true);
        $this->available = true;
        $this->description = '';
        if ($temp != null){
            if ($temp['type'] == 'date'){
                $this->description = 'Available until ' . date('F j, Y', strtotime($temp['date']));
                if ($temp['date'] < '2021-09-00')
                    $this->available = false;
            }
            else {
                $this->description = $temp['amount'] . ' tickets available';
                if ((int)$temp['amount'] <= (int)$this->registration->count())
                    $this->available = false;
            }
        }
    }
}
