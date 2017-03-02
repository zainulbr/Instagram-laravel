<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function index()
    {
        return View('user/change_password');
    }

    public function save(Request $request)
    {
        $old = $request->input('oldpassword');
        $p1 = $request->input('p1');
        $p2 = $request->input('p2');

        if(!auth()->user()->comparePassword($old)){
            return redirect()->route('user-profile-edit-password')
                ->with(['status' => 'danger', 'title'=>'Whoops!!', 'message' => 'Failed to change profile. Old password not same!!!']);
        }

        if($p2 !== $p1){
            return redirect()->route('user-profile-edit-password')
                ->with(['status' => 'danger', 'title'=>'Whoops!!', 'message' => 'New password not same!!!']);
        }


        auth()->user()->changePassword($request->input('password'));

        return redirect()->route('user-profile-edit-password')
            ->with(['status' => 'Success', 'title'=>'Success!!', 'message' => 'Success to change password!!!']);
    }
}