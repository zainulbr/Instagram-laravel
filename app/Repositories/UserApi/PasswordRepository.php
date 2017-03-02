<?php
/**
 */

namespace App\Repositories\UserApi;


use App\User;
use Illuminate\Http\Request;

class PasswordRepository
{
    private $user;
    private $request;

    public function __construct(User $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    public function changePassword()
    {
        $old = $this->request->input('old');
        $p1 = $this->request->input('new1');
        $p2 = $this->request->input('new2');

        if(!auth()->user()->comparePassword($old)){
            return ['error'=>true, 'status' => 'danger', 'title'=>'Whoops!!', 'message' => 'Failed to change profile. Old password not match!!!'];
        }

        if($p2 !== $p1){
            return ['error'=>true, 'status' => 'danger', 'title'=>'Whoops!!', 'message' => 'new password not match!!!'];

        }

        auth()->user()->changePassword($p1);
        return ['error'=>false,'status' => 'success', 'title'=>'Success!!', 'message' => 'Success to change password!!!'];
    }
}