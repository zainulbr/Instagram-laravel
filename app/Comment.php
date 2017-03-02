<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;

class Comment extends Model
{
    protected $table = "comments";

    protected $fillable = [
    	'post_id',
    	'user_id',
    	'comment'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function post() 
    {
        return $this->belongsTo(Post::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

   

}
