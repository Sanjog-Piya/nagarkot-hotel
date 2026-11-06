<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('backend.event.index',compact('events')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('backend.event.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event;
        $event->thumbnail_img = $request->thumbnail_img;
        $event->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        $event->title = $request->title;
        $event->description = $request->description;
        $event->venue = $request->venue;
        $event->date = $request->date;
        $event->save();

        flash(translate('Event post has been created successfully'))->success();
        return redirect()->route('event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

        public function eventedit($id)
    {
        //
        $event = Event::findOrFail($id);
        return view('backend.event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function eventupdatestore(Request $request, $id) 
    {
        //
        $event = Event::findOrFail($id);
        $event->title = $request->title;
        $event->thumbnail_img = $request->thumbnail_img;
        $event->description = $request->description;
        $event->venue = $request->venue;
        $event->date = $request->date;
        $event->update();
        flash(translate('Event has been updated successfully'))->success();
        return redirect()->route('event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function eventdelete($id)
    {
        Event::findOrFail($id)->delete();
        
        return redirect()->route('event.index');
    }

        public function eventupcoming(Request $request)
    {
        $value = Event::findOrFail($request->id);
        $value->upcoming = $request->status;
        $value->save();

        return 1; 
    }

}
