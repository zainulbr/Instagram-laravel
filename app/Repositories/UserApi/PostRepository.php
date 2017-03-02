<?php
/**

 */

namespace App\Repositories\UserApi;


use App\Post;
use Illuminate\Http\Request;

class PostRepository
{
    private $request;
    private $post;

    public function __construct(Request $request, Post $post)
    {
        $this->post    = $post;
        $this->request = $request;
    }

    public function delete()
    {
        $delete = $this->post
            ->find($this->request->input('post_id'));

        $delete->delete();

        return ['error' => false, 'message' => 'sukses menghapus post'];
    }
}