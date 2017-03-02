<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Friendship extends Model
{

    protected $table = "friendships";

    protected $fillable = [
    	'user_id',
    	'friend_id'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function friend() 
    {
        return $this->belongsTo(User::class);
    }
    
}
