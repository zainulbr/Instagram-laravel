<?php

namespace App\Repositories\UserApi;

use App\Comment;
use Illuminate\Http\Request;

class CommentRepository {

    private $request;
    private $comment;

    public function __construct(Request $request, Comment $comment)
    {
        $this->comment = $comment;
        $this->request = $request;
    }

    public function add()
    {
        if($this->request->input('comment') == '' || $this->request->input('comment') == null)
            return ['error' => true, 'message' => 'your Comment is empty'];

        $new_comment = $this->comment->create([
            'post_id' => $this->request->input('post_id'),
            'user_id' => auth()->user()->id,
            'comment' => $this->request->input('comment')
        ]);

        return [
            'error' => false,
            'comment' => $new_comment->comment,
            'username' => $new_comment->user->username,
            'full_name' => $new_comment->user->full_name,
            'comment_id' => $new_comment->id
        ];
    }

    public function delete() 
    {
        $delete = $this->comment->find($this->request->input('comment_id'));
        $delete->delete();

        return [
            'error' => false,
            'comment_id' => $delete->id
        ];
    }

}