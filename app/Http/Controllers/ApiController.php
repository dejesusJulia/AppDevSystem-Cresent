<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Position;
use App\Connection;
use App\Category;
use App\Subject;

class ApiController extends Controller
{
    public function searchByName($name){
        $users = User::join('positions', 'users.position_id', '=', 'positions.id')->select('users.id AS user_id', 'users.name', 'users.email', 'users.avatar', 'positions.position')->where('users.name', 'LIKE', '%'. $name. '%')->get();

        return response()->json($users);
    }

    public function searchBySubject($subjectId, $name){
        $users = User::join('positions', 'users.position_id', '=', 'positions.id')->leftJoin('categories', 'users.id', '=', 'categories.user_id')->select('users.id AS user_id', 'users.name', 'users.email', 'users.avatar', 'positions.position', 'categories.subject_id')->where('categories.subject_id', $subjectId)->where('users.name', 'LIKE', '%' . $name . '%')->get();

        return response()->json($users);
    }

    public function searchByPosition($positionId, $name){
        $users = Category::leftJoin('users', 'categories.user_id', '=', 'users.id')->leftJoin('subjects', 'categories.subject_id', '=', 'subjects.id')->select('categories.*', 'users.name', 'users.email', 'users.avatar', 'subjects.subject_name')->where('users.position_id', $positionId)->where('users.name', 'LIKE', '%' . $name . '%')->get();

        return response()->json($users);
    }

    public function searchByPS($subjectId, $positionId, $name){
        $users = Category::join('users', 'categories.user_id', '=', 'users.id')->leftJoin('subjects', 'categories.subject_id', '=', 'subjects.id')->select('categories.*', 'users.name', 'users.email', 'users.avatar')->where('categories.subject_id', $subjectId)->where('users.position_id', $positionId)->where('users.name', 'LIKE', '%'.$name.'%')->get();

        return response()->json($users);
    }

    public function searchByNullCateg($name){
        $users = User::join('positions', 'users.position_id', '=', 'positions.id')->leftJoin('categories', 'users.id', '=', 'categories.user_id')->select('users.id AS user_id', 'users.name', 'users.email', 'users.avatar', 'positions.position')->whereNull('categories.id')->where('users.name', 'LIKE', '%'.$name.'%')->get();

        return response()->json($users);
    }

}
