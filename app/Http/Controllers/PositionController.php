<?php

namespace App\Http\Controllers;

use App\Position;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    /**
     * DISPLAY ALL POSITIONS
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
     * STORE NEW POSITION
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

        return redirect()->back()->with('message', 'Post created successfully');
    }

    /**
     * SUBMIT FORM FOR EDITING POSITION INFO
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
     * DELETE POSITION
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $users = User::where('position_id', $position->id)->get();
        $defaultPositionId = 9;
        $userIds = [];
        if($users !== null){
            foreach($users as $user){
                array_push($userIds, $user->id);
            }

            User::whereIn('id', $userIds)->update(['position_id' => $defaultPositionId]);
        }

        Position::where('id', $position->id)->delete();
        return redirect()->back()->with('message', 'Post deleted successfully');
    }

    // GET POSITION COUNT
    public function getPositionCount(){
        return Position::count();
    }
}
