<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'team_name', 'team_vision', 'team_objectives', 'team_members'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
