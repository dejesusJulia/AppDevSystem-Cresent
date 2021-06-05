<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'avatar', 'portfolio', 'website', 'about', 'user_role', 'position_id', 'team_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function positions(){
        return $this->belongsTo(Position::class);
    }

    public function teams(){
        return $this->belongsTo(Team::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function connectSenders(){
        return $this->hasMany('App\Connection', 'sender_id', 'id');
    }

    public function connectReceivers(){
        return $this->hasMany('App\Connection', 'receiver_id', 'id');
    }

    // public static function checkOldFiles($avatar, $portfolio){
    //     if(auth()->user()->avatar){
    //         Storage::delete('/public/avatars/' . auth()->user()->avatar);
    //         $avatar->store('avatars', 'public');
    //     }

    //     if(auth()->user()->portfolio){
    //         Storage::delete('/public/resumes/' . auth()->user()->portfolio);
    //         $portfolio->store('resumes', 'public');
    //     }
    // }
}
