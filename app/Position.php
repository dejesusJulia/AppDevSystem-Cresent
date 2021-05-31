<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'post', 'post_description'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
