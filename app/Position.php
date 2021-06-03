<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'position', 'post_description'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
