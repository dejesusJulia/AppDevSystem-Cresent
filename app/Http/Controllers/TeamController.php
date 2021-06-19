<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use App\Connection;
// use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    **/
    public function index()
    {
        $teams = Team::join('users', 'teams.id', '=', 'users.team_id')->select('teams.*', 'users.id AS user_id', 'users.name', 'users.email')->get();
        
        return $teams;
    }

    public function getTeamNames(){
        $teams = Team::select('id', 'team_name', 'created_at')->get();
        return $teams;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-team');
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        $teammates = User::join('positions', 'users.position_id', '=', 'positions.id')->select('users.id', 'users.name', 'users.email', 'users.avatar', 'positions.position')->where('users.team_id', $team->id)->get();

        $group = [
            'details' => Team::where('id', $team->id)->first(), 
            'members' => $teammates
        ];
        
        return view('team-show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
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
            'sent' => Connection::leftJoin('users', 'connections.receiver_id', '=', 'users.id')->select('connections.*', 'users.name', 'users.email')->where('connections.accept', 1)->whereNull('users.team_id')->where('connections.sender_id', $userId)->orderBy('accept', 'desc')->get(), 

            'received' => Connection::leftJoin('users', 'connections.sender_id', '=', 'users.id')->select('connections.*', 'users.name', 'users.email')->whereNull('users.team_id')->where('connections.accept', 1)->where('connections.receiver_id', $userId)->orderBy('accept', 'asc')->get(), 

            'members' => User::select('users.id', 'users.name', 'users.email')->where('team_id', $teamId)->get(), 

            'teamInfo' => $teamInfo
        ];
        return view('edit-team', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, Team $team)
    {
        $team = $request->all();
        Team::where('id', auth()->user()->id)->update($team);
        return redirect()->back()->with('message', 'Team details updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($team)
    {
        $users = User::select('id')->where('team_id', $team)->get();
        $ids = [];
        foreach($users as $u){
            array_push($ids, $u->id);
        }
        User::whereIn('id', $ids)->update(['team_id' => null]);
        Team::where('id', $team)->delete();
        return redirect()->route('home')->with('message', 'Team deleted');

        // dd($users);
    }

    public function addMemberSent($member){
        User::where('id', $member)->update(['team_id' => auth()->user()->team_id]);

        return redirect()->back()->with('message', 'Member added!');
    }

    public function addMemberReceived($member){
        User::where('id', $member)->update(['team_id' => auth()->user()->team_id]);

        return redirect()->back()->with('message', 'Member added!');
    }

    public function removeMember($member){
        User::where('id', $member)->update(['team_id' => null]);
        return redirect()->back()->with('message', 'Member removed.');
    }

    public function teamCount(){
        return Team::count();
    }
}
