<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Position;
use App\Connection;
use App\Category;
use App\Subject;
use App\Team;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{
    // SEARCH ALL USERS 
    public function searchByName($name){
        $users = User::join('positions', 'users.position_id', '=', 'positions.id')->select('users.id AS user_id', 'users.name', 'users.email', 'users.avatar', 'positions.position')->where('users.name', 'LIKE', '%'. $name. '%')->paginate(10);

        return response()->json($users);
    }

    // SEARCH BY SUBJECT/FIELD OF EXPERTISE
    public function searchBySubject($subjectId, $name){
        $users = User::join('positions', 'users.position_id', '=', 'positions.id')->leftJoin('categories', 'users.id', '=', 'categories.user_id')->select('users.id AS user_id', 'users.name', 'users.email', 'users.avatar', 'positions.position', 'categories.subject_id')->where('categories.subject_id', $subjectId)->where('users.name', 'LIKE', '%' . $name . '%')->paginate(10);

        return response()->json($users);
    }

    // SEARCH BY POSITION
    public function searchByPosition($positionId, $name){
        // $users = Category::leftJoin('users', 'categories.user_id', '=', 'users.id')->leftJoin('subjects', 'categories.subject_id', '=', 'subjects.id')->select('categories.*', 'users.name', 'users.email', 'users.avatar', 'subjects.subject_name')->where('users.position_id', $positionId)->where('users.name', 'LIKE', '%' . $name . '%')->paginate(10);

        $users = Category::leftJoin('users', 'categories.user_id', '=', 'users.id')->leftJoin('subjects', 'categories.subject_id', '=', 'subjects.id')->select('categories.*', 'users.name', 'users.email', 'users.avatar', 'subjects.subject_name')->where('users.position_id', $positionId)->where('users.name', 'LIKE', '%' . $name . '%')->get();
        $userCollect = [];
        foreach($users as $user){
            if(empty($userCollect)){
                $userCollect[] = [
                    'user_id' => $user->user_id,
                    'avatar' => $user->avatar,
                    'name' => $user->name,
                    'email' => $user->email,
                    'subject_name' => [$user->subject_name]
                ];
            }else if(in_array($user->user_id, array_column($userCollect, 'user_id'))){
                $key = key($userCollect);
                array_push($userCollect[$key]['subject_name'], $user->subject_name); 
          
            }else if(!in_array($user->user_id, array_column($userCollect, 'user_id'))){
                array_push($userCollect, [
                    'user_id' => $user->user_id,
                    'avatar' => $user->avatar,
                    'name' => $user->name,
                    'email' => $user->email,
                    'subject_name' => [$user->subject_name]
                ]);
            }
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = array_slice($userCollect, $perPage*($currentPage -1), $perPage);

        $paginator = new LengthAwarePaginator($currentItems, count($userCollect), $perPage, $currentPage);
        return response()->json($paginator);
    }

    // SEARCH USERS BY POSITION AND SUBJECT
    public function searchByPS($subjectId, $positionId, $name){
        $users = Category::join('users', 'categories.user_id', '=', 'users.id')->leftJoin('subjects', 'categories.subject_id', '=', 'subjects.id')->select('categories.*', 'users.name', 'users.email', 'users.avatar')->where('categories.subject_id', $subjectId)->where('users.position_id', $positionId)->where('users.name', 'LIKE', '%'.$name.'%')->paginate(10);

        return response()->json($users);
    }

    // SEARCH USERS WITH NO REGISTERED FIELD/SUBJECT
    public function searchByNullCateg($name){
        $users = User::join('positions', 'users.position_id', '=', 'positions.id')->leftJoin('categories', 'users.id', '=', 'categories.user_id')->select('users.id AS user_id', 'users.name', 'users.email', 'users.avatar', 'positions.position')->whereNull('categories.id')->where('users.name', 'LIKE', '%'.$name.'%')->paginate(10);

        return response()->json($users);
    }

    // COUNT USERS PER POSITION
    public function positionUserCount(){
        $positionOfUser = [];
        $ctr = 0;
        $upp = User::leftJoin('positions', 'users.position_id', '=', 'positions.id')->select(DB::raw('count(*) as user_count'), 'users.position_id')->groupBy('position_id')->get();
        $positionNames = Position::select('id', 'position')->get();

        foreach($upp as $count){
            if($count->position_id === null){
                $positionOfUser[$ctr]['position'] = 'none';
                $positionOfUser[$ctr]['count'] = $count->user_count;
            }else{
                foreach($positionNames as $post){
                    if($count->position_id == $post->id){
                        $positionOfUser[$ctr]['position'] = $post->position;
                        $positionOfUser[$ctr]['count'] = $count->user_count;
                    }
                }    
            }
            $ctr++;
        }
        return response()->json(collect($positionOfUser));
    }

    // PUSH POSITION NAME OF USERS/POSITION TO ARRAY
    public function upCountArray(){
        $upp = $this->positionUserCount();
        $json = json_decode($upp->content());
        $countArr = [];
        $c = 0;
        foreach($json as $j){
            $countArr[$c] = $j->count;
            $c++;
        }

        return $countArr;
    }

    // PUSH COUNT OF USERS/POSITION TO ARRAY
    public function upPositionArray(){
        $upp = $this->positionUserCount();
        $json = json_decode($upp->content());
        $positionArr = [];
        $c = 0;
        foreach($json as $j){
            $positionArr[$c] = $j->position;
            $c++;
        }

        return $positionArr;
    }

    // COUNT USERS PER SUBJECT
    public function subjectUserCount(){
        $subOfUser = [];
        $ctr = 0;

        $userCount = Category::select(DB::raw('count(*) as user_count'), 'subject_id')->groupBy('subject_id')->get();

        $subjects = Subject::select('id', 'subject_name')->get();

        foreach($userCount as $s){
            if($s->subject_id === null){
                $subOfUser[$ctr]['subject'] = 'user specified';
                $subOfUser[$ctr]['count'] = $s->user_count;
            }else{
                foreach($subjects as $sub){
                    if($s->subject_id == $sub->id){
                        $subOfUser[$ctr]['subject'] = $sub->subject_name;
                        $subOfUser[$ctr]['count'] = $s->user_count;
                    }
                }
            }
            $ctr++;
        }

        return response()->json(collect($subOfUser));
    }

    // PUSH COUNT OF USER/SUBJECT TO ARRAY
    public function usCountArray(){
        $ups = $this->subjectUserCount();
        $json = json_decode($ups->content());
        $countArr = [];
        $c = 0;
        foreach($json as $j){
            array_push($countArr, $j->count);
        }

        return $countArr;
    }

    // PUSH SUBJECT OF USER/SUBJECT TO ARRAY
    public function usSubjectArray(){
        $ups = $this->subjectUserCount();
        $json = json_decode($ups->content());
        $subjectArr = [];
        $c = 0;
        foreach($json as $j){
            array_push($subjectArr, $j->subject);
        }

        return $subjectArr;
    }

    // GET NUMBER OF USERS REGISTERED PER DAY
    public function registeredUsersCount(){
        $users = User::select(DB::raw('count(*) as user_count'), DB::raw('DATE(created_at) as date'))->groupBy('date')->get();

        return response()->json($users);
    }

    // STORE DATE OF USER REGISTRATION TO ARRAY
    public function regUsersDate(){
        $reg = $this->registeredUsersCount();
        $json = json_decode($reg->content());
        $regDate = [];

        foreach($json as $j){
            array_push($regDate, $j->date);
        }

        return $regDate;
    }

    // STORE COUNT OF USER REGISTRATION TO ARRAY
    public function regUsersCount(){
        $reg = $this->registeredUsersCount();
        $json = json_decode($reg->content());
        $regCount = [];

        foreach($json as $j){
            array_push($regCount, $j->user_count);
        }

        return $regCount;
    }

    // GET COUNT OF MEMBERS PER TEAM
    public function teamMembersCount(){
        $userCount = User::select(DB::raw('count(*) as user_count'), 'team_id')->groupBy('team_id')->orderBy('team_id', 'desc')->get();
        $teams = Team::select('id', 'team_name')->get();
        $teamsArr = [];
        $t = 0;

        foreach($userCount as $uc){
            if($uc->team_id === null){
                $teamsArr[$t]['team_name'] = 'no team';
                $teamsArr[$t]['team_id'] = 0;
                $teamsArr[$t]['count'] = $uc->user_count;
            }else{
                foreach($teams as $team){
                    if($team->id == $uc->team_id){
                        $teamsArr[$t]['team_name'] = $team->team_name;
                        $teamsArr[$t]['team_id'] = $team->id;
                        $teamsArr[$t]['count'] = $uc->user_count;
                    }
                }
            }
            $t++;
        }
        
        return response()->json(collect($teamsArr));
    }

    public function betweenDates($startDate, $endDate){
        $connections = Connection::select(DB::raw('count(*) as user_count'))->whereBetween('created_at', [$startDate, $endDate])->first();

        return $connections;
    }

    public function getWeeklyDatesPerMonth(){
        $year = date('Y');
        $month = date('F');
        $firstDay = date('F d Y', strtotime('first day of ' . $month . ' ' . $year));
        $lastDay = date('F d Y', strtotime('last day of ' . $month . ' ' . $year));
        $week1 = Carbon::parse($firstDay)->format('W');
        $weekL = Carbon::parse($lastDay)->format('W');
        $weekDiff = intval($weekL) - intval($week1);

        $firstweekDay1 = date('F d Y', strtotime(Carbon::parse($firstDay)->startOfWeek()->toDateString()));
        $lastweekDay1 = date('F d Y' ,strtotime(Carbon::parse($lastDay)->startOfWeek()->toDateString()));
        $lwDay1 = Carbon::parse($lastDay)->startOfWeek()->toDateString();

        $datesArr = [$firstweekDay1];
        $endDates = [date('F d Y', strtotime('+6 days ' . $firstweekDay1))];
        $index = [];
        $j = 0;

        for($i = $weekDiff; $i > 0; $i--){
            $index[$j] = date('F d Y', strtotime('-'. strval($i) . ' weeks ' . strval($lwDay1)));
            if($index[$j] !== $firstweekDay1){
                array_push($datesArr, $index[$j]);
                array_push($endDates, date('F d Y', strtotime('+6 days ' . $index[$j])));
            }
            $j++;
        }
        array_push($datesArr, $lastweekDay1);
        array_push($endDates, date('F d Y', strtotime('+6 days ' . $lastweekDay1)));
        
        return [
            'startDates' => $datesArr, 
            'endDates' => $endDates
        ];
    }

    public function getWeekLabels(){
        $weekDate = $this->getWeeklyDatesPerMonth();
        $weekDateCount = count($weekDate['startDates']);
        $dateLabels = [];

        for($d = 0; $d < $weekDateCount; $d++){
            $dateLabels[$d] = date('m/d', strtotime($weekDate['startDates'][$d])) . ' - ' . date('m/d', strtotime($weekDate['endDates'][$d]));
        }

        return $dateLabels;
    }

    public function connectionsData(){
        $weekDates = $this->getWeeklyDatesPerMonth();
        $weekDateCount = count($weekDates['startDates']);
        $dateRangeCount = [];        
        $rand = '';

        for($i=0; $i < $weekDateCount; $i++){
            $rand = $this->betweenDates(date('Y-m-d', strtotime($weekDates['startDates'][$i])), date('Y-m-d', strtotime($weekDates['endDates'][$i])))->user_count;

            array_push($dateRangeCount, $this->betweenDates(date('Y-m-d', strtotime($weekDates['startDates'][$i])), date('Y-m-d', strtotime($weekDates['endDates'][$i])))->user_count);
            
        }

        return $dateRangeCount;
    }
}
