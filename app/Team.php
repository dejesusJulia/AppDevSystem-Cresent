<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'team_name', 'team_vision', 'team_objectives'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
