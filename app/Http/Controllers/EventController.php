<?php

namespace App\Http\Controllers;

use App\Event;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventList = Event::where("organizer_id", Auth::user()->id)->get();
        foreach ($eventList as $event){
            $event->registrations = $event->registration->count();
        }
        return view("event.index", compact("eventList"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("event.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
           "name" => "required",
           "slug" => "required|regex:/^([a-z0-9]+(-[a-z0-9]+)*)$/",
           "date" => "required|date"
        ], [
            "slug.regex" => "Slug must not be empty and only contain a-z, 0-9 and
 '-'"
        ]);

        $slugUsed = Auth::user()->event->where("slug", $data['slug'])->first();

        if ($slugUsed != null){
            return back()->withErrors([
                "slug" => "Slug is already used"
            ])->withInput();
        }

        $newEvent = Auth::user()->event()->create($data);

        return redirect()->route("event.show", $newEvent->id)->with([
            "message" => "Event successfully created"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        if ($event->organizer->id != Auth::user()->id){
            abort(404);
        }

        return view("event.show", compact("event"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view("event.edit", compact("event"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            "name" => "required",
            "slug" => "required|regex:/^([a-z0-9]+(-[a-z0-9]+)*)$/",
            "date" => "required|date"
        ], [
            "slug.regex" => "Slug must not be empty and only contain a-z, 0-9 and
 '-'"
        ]);

        $slugUsed = Auth::user()->event->where("id", "<>", $event->id)
            ->where("slug", $data['slug'])->first();

        if ($slugUsed != null){
            return back()->withErrors([
                "slug" => "Slug is already used"
            ])->withInput();
        }

        $event->update($data);

        return redirect()->route("event.show", $event->id)->with([
            "message" => "Event successfully updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
