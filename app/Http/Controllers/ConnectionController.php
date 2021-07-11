<?php

namespace App\Http\Controllers;

use App\Connection;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # SEND
        $data = $request->all();
        Connection::create($data);
        return redirect()->back()->with('message', 'Request sent!');
    }

    /**
     * Remove the specified resource from storage.
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
    // public function getSent($userId){
    //     $sent = Connection::leftJoin('users', 'connections.receiver_id', '=', 'users.id')->select('connections.*', 'users.name', 'users.email', 'users.team_id')->where('connections.sender_id', $userId)->orderBy('accept', 'desc')->get();

    //     return $sent;
    // }

    // GET ALL REQUESTS RECEIVED BY USER
    // public function getReceived($userId){
    //     $received = Connection::leftJoin('users', 'connections.sender_id', '=', 'users.id')->select('connections.*', 'users.name', 'users.email', 'users.team_id')->where('connections.receiver_id', $userId)->orderBy('accept', 'asc')->get();

    //     return $received;
    // }

    
}
