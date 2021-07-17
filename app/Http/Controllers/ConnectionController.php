<?php

namespace App\Http\Controllers;

use App\Connection;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{
    protected $true = 1;

    /**
     * STORE(SEND) NEW CONNECTION REQUEST
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Connection::create($data);
        return redirect()->back()->with('message', 'Request sent!');
    }

    /**
     * DELETE SENT CONNECTION REQUEST 
     *
     * @param  \App\Connection  $connection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Connection $connection)
    {
        Connection::where('id', $connection->id)->delete();
        return redirect()->back();
    }

    // ACCEPT CONNECTION REQUEST
    public function acceptRequest(Connection $connection){
        Connection::where('id', $connection->id)->update(['accept' => true]);
        return redirect()->back();
    }

    // DECLINE CONNECTION REQUEST
    public function declineRequest(Connection $connection){
        Connection::where('id', $connection->id)->update(['accept' => false]);
        return redirect()->back();
    }

    // GET ALL REQUESTS SENT BY USER
    public function getSent($userId){
        $sent = Connection::leftJoin('users', 'connections.receiver_id', '=', 'users.id')->select('connections.*', 'users.name', 'users.email', 'users.team_id')->where('connections.sender_id', $userId)->orderBy('accept', 'desc')->get();

        return $sent;
    }

    // GET ALL REQUESTS RECEIVED BY USER
    public function getReceived($userId){
        $received = Connection::leftJoin('users', 'connections.sender_id', '=', 'users.id')->select('connections.*', 'users.name', 'users.email', 'users.team_id')->where('connections.receiver_id', $userId)->orderBy('accept', 'asc')->get();

        return $received;
    }

    // GET ACCEPTED SENT REQUESTS
    public function acceptedSent($userId){
        $sent = Connection::leftJoin('users', 'connections.receiver_id', '=', 'users.id')->select('connections.*', 'users.name', 'users.email')->where('connections.accept', $this->true)->whereNull('users.team_id')->where('connections.sender_id', $userId)->orderBy('accept', 'desc')->get();

        return $sent;
    }

    // GET ACCEPTED RECEIVED REQUESTS
    public function acceptedReceived($userId){
        $received = Connection::leftJoin('users', 'connections.sender_id', '=', 'users.id')->select('connections.*', 'users.name', 'users.email')->whereNull('users.team_id')->where('connections.accept', $this->true)->where('connections.receiver_id', $userId)->orderBy('accept', 'asc')->get();

        return $received;
    }

    
}
