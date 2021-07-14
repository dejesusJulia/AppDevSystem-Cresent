<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use App\Http\Requests\TeamRequest;

class TeamController extends Controller
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new ConnectionController();
    }
    /**
     * DISPLAY ALL TEAMS 
     *
     * @return \Illuminate\Http\Response
    **/
    public function index()
    {
        $teams = Team::select('id', 'team_name', 'created_at')->get();
        return $teams;
    }

    /**
     * SHOW FORM FOR CREATING NEW TEAM
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-team');
    }

    /**
     * STORE THE NEWLY CREATED TEAM 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        $data = $request->all();
        Team::create($data);
        $teamId = Team::select('id')->where('team_name', $request->team_name)->first();

        auth()->user()->update(['team_id' => $teamId->id]);
        return redirect()->back()->with('message', 'Team created');
    }

    /**
     * DISPLAY ONE TEAM INFO AND MEMBERS
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        // GET MEMBERS
        $teammates = User::join('positions', 'users.position_id', '=', 'positions.id')->select('users.id', 'users.name', 'users.email', 'users.avatar', 'positions.position')->where('users.team_id', $team->id)->get();

        $group = [
            'details' => Team::where('id', $team->id)->first(), 
            'members' => $teammates
        ];
        
        return view('team-show', compact('group'));
    }

    /**
     * SHOW FORM FOR EDITING TEAM INFO
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $teamInfo = Team::where('id', auth()->user()->team_id)->first();
        $userId = auth()->user()->id;
        $teamId = auth()->user()->team_id;

        $data = [
            'sent' => $this->connection->acceptedSent($userId), 

            'received' => $this->connection->acceptedReceived($userId), 

            'members' => User::select('users.id', 'users.name', 'users.email', 'users.position_id')->where('team_id', $teamId)->get(), 

            'teamInfo' => $teamInfo
        ];
        return view('edit-team', compact('data'));
    }

    /**
     * SUBMIT THE FORM FOR EDITING TEAM INFO
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, Team $team)
    {
        $team = $request->except(['_token', '_method']);
        Team::where('id', auth()->user()->team_id)->update($team);
        return redirect()->back()->with('message', 'Team details updated!');
    }

    /**
     * DELETE THE TEAM
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($team)
    {
        // GET ALL MEMBERS
        $users = User::select('id')->where('team_id', $team)->get();
        $ids = [];
        foreach($users as $u){
            array_push($ids, $u->id);
        }

        // REMOVE ALL MEMBERS
        User::whereIn('id', $ids)->update(['team_id' => null]);

        // DELETE TEAM
        Team::where('id', $team)->delete();

        return redirect()->route('home')->with('message', 'Team deleted');
    }

    // ADD MEMBER
    public function addMember($member){
        User::where('id', $member)->update(['team_id' => auth()->user()->team_id]);

        return redirect()->back()->with('message', 'Member added!');
    }

    // REMOVE A MEMBER
    public function removeMember($member){
        User::where('id', $member)->update(['team_id' => null]);
        return redirect()->back()->with('message', 'Member removed.');
    }

    // NUMBER OF TEAMS
    public function teamCount(){
        return Team::count();
    }
}
