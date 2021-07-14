<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserInfoRequest;
use App\Http\Requests\AdminInfoRequest;
use App\User;
use App\Position;
use App\Category;
use App\Connection;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $connection;
    protected $category;

    public function __construct()
    {
        $this->connection = new ConnectionController();
        $this->category = new CategoryController();
    }
    /**
     * DISPLAY LIST OF ALL USERS
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::leftJoin('positions', 'users.position_id', '=', 'positions.id')->select('users.*', 'positions.position')->get();

        return view('admin.users', compact('users'));
    }

    /**
     * VIEW A SPECIFIC USER'S PROFILE
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
     * SHOW THE FORM FOR EDITING (COMMON) USER'S PROFILE
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
     * SUBMIT THE FORM FOR EDITING (COMMON) USER'S PROFILE
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
     * DELETE USER
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $categories = $this->category->getUserCateg($user->id);
        $connections_sender = $this->connection->getSent($user->id);
        $connections_receiver = $this->connection->getReceived($user->id);

        if(!is_array($categories) || !in_array(0, $categories) || is_a($categories, 'Illuminate\Database\Eloquent\Collection')){
            Category::where('user_id', $user->id)->delete();
        }

        if($connections_sender !== null){
            Connection::where('sender_id', $user->id)->delete();
        }

        if($connections_receiver !==null){
            Connection::where('receiver_id', $user->id)->delete();
        }

        User::where('id', $user->id)->delete();
        return redirect()->back()->with('message', 'User deleted successfully');
    }

    // VIEW PDF OF USER RESUME/CV
    public function viewPdf($pdf){
        return view('pdf-viewer', compact('pdf'));
    }

    // DOWNLOAD PDF OF USER RESUME/CV
    public function downloadPdf($pdf){
        return response()->download(public_path('storage/resumes/' . $pdf));
    }

    // SHOW THE FORM FOR EDITING ADMIN'S PROFILE (GET REQUEST)
    public function adminEditProfile(){
        $admin = User::select('name', 'email', 'avatar', 'website')->where('id', auth()->user()->id)->first();

        return view('admin.edit-admin-profile', compact('admin'));
    }

    // SUBMIT THE FORM FOR EDITING ADMIN PROFILE (POST REQUEST)
    public function adminUpdateProfile(AdminInfoRequest $request){
        $userId = auth()->user()->id;
        $avatar = User::select('avatar')->where('id', $userId)->first();     
        $data = [
            'name' => $request->name, 
            'email' => $request->email, 
            'website' => $request->website,
        ];

        // IF AN IMAGE IS UPLOADED
        if($request->hasFile('avatar')){
            // CHECK FOR OLD IMAGE
            if($avatar !== null){
                // DELETE OLD IMAGE
                Storage::delete('/public/avatars/' . auth()->user()->avatar);
            }
            // REPLACE OLD IMAGE
            $request->avatar->store('avatars', 'public');
            $imgname = $request->avatar->hashName();
            $data['avatar'] = $imgname;
        } 

        auth()->user()->update($data);
        return redirect()->back()->with('message', 'Profile successfully updated');
    }

}
