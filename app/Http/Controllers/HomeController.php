<?php

namespace App\Http\Controllers;

use App\User;
use App\Position;
use Illuminate\Http\Request;
use App\Http\Requests\NewUserInfoRequest;
// use Illuminate\Support\Facades\Validator;

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
        // $this->middleware('user');
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
            return view('home');
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
        return view('admin.dash');
    }

    
}
