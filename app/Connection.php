<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id', 'accept'
    ];

    public function senderUsers(){
        return $this->belongsto('App\User', 'sender_id', 'id');
    }

    public function receiverUsers(){
        return $this->belongsTo('App\User', 'receiver_id', 'id');
    }
}
