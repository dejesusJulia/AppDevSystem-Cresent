<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Position;
use App\Connection;

class ApiController extends Controller
{
    public function searchByName($name){
        $users = User::join('positions', 'users.position_id', '=', 'positions.id')->select('users.name', 'users.email', 'users.avatar', 'positions.position')->where('users.name', 'LIKE', '%'. $name. '%')->get();

        return response()->json($users, 200);
    }
    
    public function trySearch(){
        return response()->json(User::all(), 200);
    }

}
