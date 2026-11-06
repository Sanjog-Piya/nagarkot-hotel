<?php

namespace App\Http\Controllers;

use App\Models\Collaboration;
use Illuminate\Http\Request;

class CollaborationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $collabs = Collaboration::all();
        return view('backend.collab.index',compact('collabs')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
                 return view('backend.collab.create'); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $collab = new Collaboration;
        $collab->thumbnail_img = $request->thumbnail_img;
        $collab->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
         $collab->title = $request->title;
        $collab->collab_link = $request->collab_link;
        $collab->short_description = $request->short_description;
        $collab->save();

        flash(translate('Collaboration post has been created successfully'))->success();
        return redirect()->route('collab.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collaboration  $collaboration
     * @return \Illuminate\Http\Response
     */
    public function show(Collaboration $collaboration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collaboration  $collaboration
     * @return \Illuminate\Http\Response
     */
    public function edit(Collaboration $collaboration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collaboration  $collaboration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collaboration $collaboration)
    {
        //
    }


        public function collabedit($id)
    {
        //
        $collab = Collaboration::findOrFail($id);
        return view('backend.collab.edit',compact('collab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function collabupdatestore(Request $request, $id) 
    {
        //
        $collab = Collaboration::findOrFail($id);
        $collab->title = $request->title;
        $collab->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        $collab->thumbnail_img = $request->thumbnail_img;
        $collab->collab_link = $request->collab_link;
        $collab->short_description = $request->short_description;
        $collab->update();
        flash(translate('Collaboration has been updated successfully'))->success();
        return redirect()->route('collab.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collaboration  $collaboration
     * @return \Illuminate\Http\Response
     */
    public function cdestroy($id)
    {
                Collaboration::findOrFail($id)->delete();
        
        return redirect()->route('collab.index');
    }
}
