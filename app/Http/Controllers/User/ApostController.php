<?php 

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use DB;
class ApostController extends Controller
{
    public function index()
    {
        $post = Post::get();
        $reports= $post->map(function($report){
            return [
            'id' => $report->id,
            'user' => $report->user->username,
            'caption' => $report->caption,
            'created_at' => $report->created_at->toDateTimeString()
            ];
        });

        return view('admin/Apost')->with(['reports'=>$reports]);
    }   
}