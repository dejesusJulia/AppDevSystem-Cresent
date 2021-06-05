<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserInfoRequest;
use App\User;
use App\Position;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::join('positions', 'users.position_id', '=', 'positions.id')->get();
        $users = User::leftJoin('positions', 'users.position_id', '=', 'positions.id')->select('users.*', 'positions.position')->get();

        return view('admin.users', compact('users'));
        // dd($users);
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
    public function store(UserInfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $authUser = User::where('id', auth()->user()->id)->first();
        $positions = Position::all();
        $data = [
            'authUser' => $authUser, 
            'positions' => $positions
        ];
        return view('profile-edit', compact('data'));
        // dd($auth);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserInfoRequest $request)
    {
        if(auth()->user()->avatar){
            Storage::delete('/public/avatars/' . auth()->user()->avatar);
            $request->avatar->store('avatars', 'public');
        }

        if(auth()->user()->portfolio){
            Storage::delete('/public/resumes/' . auth()->user()->portfolio);
            $request->portfolio->store('resumes', 'public');
        }

        $data = [
            'name' => $request->name, 
            'email' => $request->email, 
            'avatar' => $request->avatar->hashName(), 
            'portfolio' => $request->portfolio->hashName(), 
            'website' => $request->website,
            'about' => $request->about,
            'position_id' => $request->position_id
        ];

        auth()->user()->update($data);
        return redirect()->back()->with('message', 'Profile updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::where('id', $user)->delete();
        return redirect()->back()->with('message', 'User deleted successfully');
    }
}
