<?php

namespace App\Repositories\UserApi;
use Illuminate\Http\Request;
use App\Like;
use App\Post;
use App\Friendship;

class LikeRepository {

    private $request;
    private $post;
    private $like;
    private $friend;

    public function __construct(Request $request, Post $post, Friendship $friend, Like $like)
    {
        $this->friend  = $friend;
        $this->post    = $post;
        $this->like = $like;
        $this->request = $request;
    }

    public function like()
    {
        $post_id = $this->request->input('post_id');

        $post = Post::find($post_id);
        if($post->isLiked()) return ['error' => true, 'message' => 'anda sudah menambahkan like'];

        $newLike = $this->like->create([
            'post_id' => $post_id,
            'user_id' => auth()->user()->id
        ]);
        
        $post = $this->post->find($post_id);
        $count = ($post->likeCount() <= 1) ? ' Star' : ' Stars';
        return ['error' => false, 'message' => 'sukses menambahkan like', 'count_like' => $post->likeCount().$count];
    }

    public function unlike()
    {
        $post_id = $this->request->input('post_id');

        $post = Post::find($post_id);
        if(!$post->isLiked()) return ['error' => true, 'message' => 'anda sudah menghapus like'];

        $liked = $this->like->where('user_id', auth()->user()->id)->where('post_id', $post_id)->firstOrFail();
        $liked->delete();

        $post = $this->post->find($post_id);
        $count = ($post->likeCount() <= 1) ? ' Star' : ' Stars';
        return ['error' => false, 'message' => 'sukses menghapus like', 'count_like' => $post->likeCount().$count];
    }
}