<?php

namespace App\Http\Controllers;

use App\User;
use App\Subject;
use App\Category;
use App\Connection;
use App\Position;
use Illuminate\Http\Request;
use App\Http\Requests\NewUserInfoRequest;

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
            $user = User::join('positions', 'users.position_id', '=', 'positions.id')->leftJoin('teams', 'users.team_id', '=', 'teams.id')->select('users.*', 'positions.position', 'teams.team_name')->where('users.id', $userId)->first();

            $categories = $this->getCategories($userId);
            $connections = $this->getConnectionJoins($userId);
            $subjects = Subject::all();

            $data = [
                'user' => $user, 
                'categories' =>$categories, 
                'sent' => $connections['sent'], 
                'received' => $connections['received'],
                'subjects' => $subjects
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
        $userCount = User::whereNotIn('id', [auth()->user()->id])->count();
        $positionCount = Position::count();
        $subjectCount = Subject::count();

        $data = [
            'userCount' => $userCount, 
            'positionCount' => $positionCount, 
            'subjectCount' => $subjectCount
        ];
        return view('admin.dash', compact('data'));
    }

    /* 
    *
    * JOINS 
    *
    */
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

    public function joinCUS(){
        $categories = Category::join('users', 'categories.user_id', '=', 'users.id')->join('subjects', 'categories.subject_id', '=', 'subjects.id')->select('categories.*', 'users.name', 'users.email', 'users.avatar', 'subjects.subject_name')->orderBy('users.created_at', 'desc')->get();

        return $categories;
    }

    public function selectByPosition($positionId){
        $subjects = Subject::all();
        $positions = Position::all();

        $data = [
            'positions' => $positions, 
            'subjects' => $subjects, 
            'positionID' => $positionId
        ];

        return view('search-by', compact('data'));
    }

    public function selectBySubject($subjectId){
        $subjects = Subject::all();
        $positions = Position::all();

        $data = [
            'positions' => $positions, 
            'subjects' => $subjects, 
            'subjectID' => $subjectId
        ];

        return view('search-by', compact('data'));
    }

    public function selectNullCateg(){
        $users = User::join('positions', 'users.position_id', '=', 'positions.id')->leftJoin('categories', 'users.id', '=', 'categories.user_id')->select('users.id AS user_id', 'users.name', 'users.email', 'users.avatar', 'positions.position')->where('categories.user_id')->get();

        $subjects = Subject::all();
        $positions = Position::all();

        $data = [
            'users' => $users, 
            'positions' => $positions, 
            'subjects' => $subjects
        ];

        return view('search-by', compact('data'));
    }


    public function selectByPS(Request $request){
        $positionId = $request->position_id;
        $subjectId = $request->subject_id;
        $subjects = Subject::all();
        $positions = Position::all();

        $data = [
            'positions' => $positions, 
            'subjects' => $subjects, 
            'positionId' => $positionId, 
            'subjectId' => $subjectId
        ];

        return view('search-by', compact('data'));
    }

    public function searchResults(){
        $subjects = Subject::all();
        $positions = Position::all();

        $data = [
            'subjects' => $subjects, 
            'positions' => $positions
        ];
        
        return view('search', compact('data'));
    }
}
