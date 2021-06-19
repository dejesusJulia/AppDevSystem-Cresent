<?php

namespace App\Http\Controllers;

use App\Connection;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // SELECT ALL CONNECTIONS GROUPED BY DATE
    }

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
     * Display the specified resource.
     *
     * @param  \App\Connection  $connection
     * @return \Illuminate\Http\Response
     */
    public function show(Connection $connection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Connection  $connection
     * @return \Illuminate\Http\Response
     */
    public function edit(Connection $connection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Connection  $connection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Connection $connection)
    {
        # 
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

    public function acceptRequest(Connection $connection){
        Connection::where('id', $connection->id)->update(['accept' => true]);
        return redirect()->back();
    }

    public function declineRequest(Connection $connection){
        Connection::where('id', $connection->id)->update(['accept' => false]);
        return redirect()->back();
    }

    public function getSent($userId){
        $sent = Connection::leftJoin('users', 'connections.receiver_id', '=', 'users.id')->select('connections.*', 'users.name', 'users.email')->where('connections.sender_id', $userId)->orderBy('accept', 'desc')->get();

        return $sent;
    }

    public function getReceived($userId){
        $received = Connection::leftJoin('users', 'connections.sender_id', '=', 'users.id')->select('connections.*', 'users.name', 'users.email')->where('connections.receiver_id', $userId)->orderBy('accept', 'asc')->get();

        return $received;
    }

    
}
