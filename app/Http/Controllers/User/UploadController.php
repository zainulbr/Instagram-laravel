<?php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        return view('user/upload');
    }

    public function upload(Request $request)
    {
        if (!$request->hasFile('image')) return redirect()->route('user-upload_image')->with(['error' => 'danger','title' => 'Whoops!!', 'message'=>'Failed to upload. Please Try Again']);

        $dest = public_path() . '/images/';
        $file = $request->file('image');

        if(!substr($file->getMimeType(), 0, 5) == 'image') return redirect()->route('user-upload_image')->with(['error' => 'danger','title' => 'Whoops!!', 'message'=>'Failed to upload. Please Try Again']);

        $newPost = $this->post->create([
            'user_id' => auth()->user()->id,
            'caption' => $request->input('caption')
        ]);

        $file->move($dest, $newPost->id.'.jpg');

        return redirect()->route('user-home');
    }
}