<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'full_name', 'email', 'password', 'birthdate', 'status_message'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function followingCount()
    {
        return Friendship::where('user_id', $this->id)->count();
    }

    public function followerCount()
    {
        return Friendship::where('friend_id', $this->id)->count();
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function isFollowed()
    {
        return Friendship::where('user_id', auth()->user()->id)
            ->where('friend_id', $this->id)->count();
    }
    public function changePassword($newpassword)
    {
        $this->password = bcrypt($newpassword);
        $this->save();
    }

    public function comparePassword($password){
        return Hash::check($password, $this->password);
    }
}
