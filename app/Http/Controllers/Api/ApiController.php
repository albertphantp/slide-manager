<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Http\Resources\EventRS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    function events(){
        $events = Event::where("date", ">", "2021-09-00")->orderBy("date")->get();

        return response()->json([
            "events" => EventRS::collection($events)
        ]);
    }


}
