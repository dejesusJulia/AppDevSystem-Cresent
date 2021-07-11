<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\NewUserInfoRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $api;
    public $team;
    public $connection;
    public $category;
    public $subject;
    public $position;

    public function __construct()
    {
        $this->middleware('auth');
        $this->api = new ApiController();
        $this->team = new TeamController();
        $this->connection = new ConnectionController();
        $this->category = new CategoryController();
        $this->subject = new SubjectController();
        $this->position = new PositionController();

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
            $sent = $this->api->getSent($userId);
            $received = $this->api->getReceived($userId);
            $data = [
                'user' => $user, 
                'categories' =>$this->category->getUserCateg($userId), 
                'sent' => json_decode($sent->content()), 
                'received' => json_decode($received->content()),
                'subjects' => $this->subject->showAllSub(), 
                'positions' => $this->position->getAllPosition(), 
                'teams' => $this->team->getTeamNames()
            ];
            return view('home', compact('data'));
        }
        
    }

    // PROFILE COMPLETION GET REQUEST
    public function edit(){
        if(auth()->user()->avatar == null || auth()->user()->portfolio == null){
            $positions = $this->position->getAllPosition();
            return view('complete-profile', compact('positions'));

        }else{
            return redirect()->route('home');
        }
        
    }

    // PROFILE COMPLETION POST REQUEST
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

    // ADMIN DASHBOARD
    public function dash(){
        $userCount = User::whereNotIn('id', [auth()->user()->id])->count();
        $positionCount = $this->position->getPositionCount();
        $subjectCount = $this->subject->getSubCount();
        $teamCount = $this->team->teamCount();
        $teamMembers = $this->api->teamMembersCount();

        $data = [
            'userCount' => $userCount, 
            'positionCount' => $positionCount, 
            'subjectCount' => $subjectCount, 
            'teamCount' => $teamCount, 
            'positions' => $this->api->upPositionArray(), 
            'counts' => $this->api->upCountArray(), 
            'subjects' => $this->api->usSubjectArray(), 
            'subCount' => $this->api->usCountArray(), 
            'weeklyDates' => $this->api->getWeekLabels(),  
            'connectionCount' => $this->api->connectionsData(),  
            'teamMembers' => json_decode($teamMembers->content())
        ];
        return view('admin.dash', compact('data'));
    }

    // SEARCH PAGE: BY POSITION
    public function selectByPosition($positionId){
        $data = [
            'positions' => $this->position->getAllPosition(), 
            'subjects' => $this->subject->showAllSub(), 
            'positionID' => $positionId
        ];

        return view('search-by', compact('data'));
    }

    // SEARCH PAGE: BY SUBJECT/FIELD OF EXPERTISE
    public function selectBySubject($subjectId){
        $data = [
            'positions' => $this->position->getAllPosition(), 
            'subjects' => $this->subject->showAllSub(), 
            'subjectID' => $subjectId
        ];

        return view('search-by', compact('data'));
    }

    // SEARCH PAGE: NO SUBJECTS/FIELDS
    public function selectNullCateg(){
        $users = User::join('positions', 'users.position_id', '=', 'positions.id')->leftJoin('categories', 'users.id', '=', 'categories.user_id')->select('users.id AS user_id', 'users.name', 'users.email', 'users.avatar', 'positions.position')->where('categories.user_id')->get();

        $data = [
            'users' => $users, 
            'positions' => $this->position->getAllPosition(), 
            'subjects' => $this->subject->showAllSub()
        ];

        return view('search-by', compact('data'));
    }

    // SEARCH PAGE: BY POSITION && SUBJECT
    public function selectByPS(Request $request){
        $data = [
            'positions' => $this->position->getAllPosition(), 
            'subjects' => $this->subject->showAllSub(), 
            'positionId' =>  $request->position_id, 
            'subjectId' => $request->subject_id
        ];

        return view('search-by', compact('data'));
    }

    // SEARCH PAGE: ALL USERS
    public function searchResults(){
        $data = [
            'subjects' => $this->subject->showAllSub(), 
            'positions' => $this->position->getAllPosition()
        ];
        
        return view('search', compact('data'));
    }
}
