<?php

namespace App\Http\Controllers;

use App\User;
use App\Position;
use App\Subject;
use App\Category;
use App\Connection;
use Illuminate\Http\Request;
use App\Http\Requests\NewUserInfoRequest;
// use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->avatar == null || auth()->user()->portfolio == null){
            $route = 'complete.edit';   
            return redirect()->route($route);
        }else{
            $userId = auth()->user()->id;
            $user = User::join('positions', 'users.position_id', '=', 'positions.id')->select('users.*', 'positions.position')->where('users.id', $userId)->first();

            $subjects = Subject::all();

            $categories = $this->getCategories($userId);

            $connections = $this->getConnectionJoins($userId);

            $data = [
                'user' => $user, 
                'subjects' => $subjects, 
                'categories' =>$categories, 
                'sent' => $connections['sent'], 
                'received' => $connections['received']
            ];
            return view('home', compact('data'));
        }
        
    }

    public function edit(){
        if(auth()->user()->avatar == null || auth()->user()->portfolio == null){
            $positions = Position::all();
            return view('complete-profile', compact('positions'));

        }else{
            return redirect()->route('home');
        }
        
    }

    public function update(NewUserInfoRequest $request){ 
        $id = auth()->user()->id;
        $request->avatar->store('avatars', 'public');
        $request->portfolio->store('resumes', 'public');
        $data = [
            'avatar' => $request->avatar->hashName(),
            'portfolio' => $request->portfolio->hashName(), 
            'website' => $request->website,
            'about' => $request->about,
            'position_id' => $request->position_id
        ];

        User::where('id', $id)->update($data);
        return redirect()->route('home');
    }

    public function dash(){
        return view('admin.dash');
    }

    public function getCategories($userId){
        $user = Category::select('id')->where('user_id', $userId)->get();
        $categories = [];

        if($user == null){
            $categories = [0];
        }else{
            $categories = Category::leftJoin('subjects', 'categories.subject_id', '=', 'subjects.id')->select('categories.*', 'subjects.subject_name')->where('user_id', $userId)->get();
        }

        return $categories;
    }

    public function getConnectionJoins($userId){
        $connections = [
            'sent' => Connection::leftJoin('users', 'connections.receiver_id', '=', 'users.id')->select('connections.*', 'users.name', 'users.email')->where('connections.sender_id', $userId)->orderBy('accept', 'desc')->get(), 

            'received' => Connection::leftJoin('users', 'connections.sender_id', '=', 'users.id')->select('connections.*', 'users.name', 'users.email')->where('connections.receiver_id', $userId)->orderBy('accept', 'asc')->get()
        ]; 

        return $connections;
        
    }
}
