<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'user_id', 'subject_id', 'others'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function subjects(){
        return $this->belongsTo(Subject::class);
    }
}
