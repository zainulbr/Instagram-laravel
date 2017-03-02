<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;

class Report extends Model
{

    protected $table = "reports";

    protected $fillable = [
        'post_id',
        'reporter_id',
        'reason'
    ];


    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function reporter() {
        return $this->belongsTo(User::class);
    }

}
