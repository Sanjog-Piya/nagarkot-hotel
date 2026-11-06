<?php

namespace App\Http\Controllers;

use App\Models\Join;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $joins = Join::all();
        return view('backend.join.index',compact('joins')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('backend.join.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $join = new Join;
        $join->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        $join->title = $request->title;
        $join->short_description = $request->short_description;
        $join->save();

        flash(translate('New post has been created successfully'))->success();
        return redirect()->route('join.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Join  $join
     * @return \Illuminate\Http\Response
     */
    public function show(Join $join)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Join  $join
     * @return \Illuminate\Http\Response
     */
    public function edit(Join $join)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Join  $join
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Join $join)
    {
        //
    }


        public function joinedit($id)
    {
        //
        $join = Join::findOrFail($id);
        return view('backend.join.edit',compact('join'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function joinupdatestore(Request $request, $id) 
    {
        //
        $join = Join::findOrFail($id);
        $join->title = $request->title;
        $join->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        $join->short_description = $request->short_description;
        $join->update();
        flash(translate('Post has been updated successfully'))->success();
        return redirect()->route('join.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Join  $join
     * @return \Illuminate\Http\Response
     */
    public function destroy(Join $join)
    {
        //
    }
}
