<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;


class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::all();
        return view('admin.positions', compact('positions'));
    }

    public function getAllPosition(){
        return Position::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'position' => 'required|max:255', 
            'post_description' => 'required|max:255'
        ]);

        Position::create($data);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        $post = Position::where('id', $position->id)->get();
        // return view();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $data = $request->validate([
            'position' => 'required|max:255', 
            'post_description' => 'required|max:255'
        ]);

        Position::where('id', $position->id)->update($data);

        return redirect()->back()->with('message', 'Position updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        Position::where('id', $position->id)->delete();
        return redirect()->back()->with('message', 'Post deleted successfully');
    }

    public function getPositionCount(){
        return Position::count();
    }
}
