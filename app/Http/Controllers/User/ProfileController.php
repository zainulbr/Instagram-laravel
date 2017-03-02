<?php


namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request, $username)
    {
        if(auth()->user()->username == $username)
            return $this->self();
        else
            return $this->profile($username);
    }

    private function self()
    {
        $data = [
            'post_count' => auth()->user()->post->count(),
            'follower_count' => auth()->user()->followerCount(),
            'following_count' => auth()->user()->followingCount(),
        ];

        return View('user/profile_self', ['data' => $data]);
    }

    private function profile($username)
    {
        $result = User::where('username', $username)->first();
        if($result == null) return redirect()->route('user-home');
        
        $data = [
            'is_followed' => $result->isFollowed(),
            'follower_count' => $result->followerCount(),
            'following_count' => $result->followingCount(),
            'post_count' => $result->post->count(),
            'identity' => $result
        ];

        return View('user/profile_someone', ['data' => $data]);
    }
}