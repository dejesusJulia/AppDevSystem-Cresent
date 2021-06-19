<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserInfoRequest;
use App\Http\Requests\AdminInfoRequest;
use App\User;
use App\Position;
use App\Connection;
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
        $users = User::leftJoin('positions', 'users.position_id', '=', 'positions.id')->select('users.*', 'positions.position')->get();

        return view('admin.users', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $user = User::join('positions', 'users.position_id', '=', 'positions.id')->leftJoin('teams', 'users.team_id', '=', 'teams.id')->select('users.*', 'positions.position', 'teams.team_name')->where('users.id', $user)->first();

        $received = Connection::select('connections.sender_id')->where('receiver_id', auth()->user()->id)->get();

        $sent = Connection::select('connections.*')->where('sender_id', auth()->user()->id)->get();

        $data = [
            'user' => $user, 
            'received' => $received, 
            'sent' => $sent
        ];
        return view('show', compact('data'));
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
        $data = [
            'name' => $request->name, 
            'email' => $request->email, 
            'website' => $request->website,
            'about' => $request->about,
            'position_id' => $request->position_id
        ];

        if($request->hasFile('avatar')){
            Storage::delete('/public/avatars/' . auth()->user()->avatar);
            $request->avatar->store('avatars', 'public');
            $imgname = $request->avatar->hashName();
            $data['avatar'] = $imgname;
        }

        if($request->hasFile('portfolio')){
            Storage::delete('/public/resumes/' . auth()->user()->portfolio);
            $request->portfolio->store('resumes', 'public');
            $filename = $request->portfolio->hashName();
            $data['portfolio'] = $filename;
        }

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
        User::where('id', $user->id)->delete();
        return redirect()->back()->with('message', 'User deleted successfully');
    }

    /* 
    * View PDF
    */
    public function viewPdf($pdf){
        return view('pdf-viewer', compact('pdf'));
    }

    /* 
    * Download PDF
    */
    public function downloadPdf($pdf){
        return response()->download(public_path('storage/resumes/' . $pdf));
    }

    // ADMIN EDIT PROFILE
    public function adminEditProfile(){
        $admin = User::select('name', 'email', 'avatar', 'website')->where('id', auth()->user()->id)->first();

        return view('admin.edit-admin-profile', compact('admin'));
    }

    // ADMIN UPDATE PROFILE
    public function adminUpdateProfile(AdminInfoRequest $request){
        $userId = auth()->user()->id;
        $avatar = User::select('avatar')->where('id', $userId)->first();     
        $data = [
            'name' => $request->name, 
            'email' => $request->email, 
            'website' => $request->website,
        ];

        if($request->hasFile('avatar')){
            if($avatar !== null){
                Storage::delete('/public/avatars/' . auth()->user()->avatar);
            }
            
            $request->avatar->store('avatars', 'public');
            $imgname = $request->avatar->hashName();
            $data['avatar'] = $imgname;
        } 
        auth()->user()->update($data);
        return redirect()->back()->with('message', 'Profile successfully updated');
    }

}
