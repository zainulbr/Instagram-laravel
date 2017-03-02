<?php

namespace App\Http\Controllers;

use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller {

    public function register(Request $request)
    {
        $cek = User::where('username', $request->input('username'))->count();
        if ($cek >= 1) return redirect()->route('register')->with(['status' => 'danger','title'=>'Error!!!', 'message' => 'Username has been registered']);

        $newUser = User::Create([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'birthdate' => $request->input('birthdate'),
            'email' => $request->input('email'),
            'full_name' => $request->input('full_name'),
        ]);

        return redirect()->route('register')
            ->with([
                'status'=>'success',
                'title'=> 'Success!!!',
                'message'=>'Registration Success, <a href="login" class="btn btn-link">Click here</a> to login'
            ]);

    }
    
     
    public function login(Request $request)
    {
        $auth = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];

        if(auth()->attempt($auth)) return redirect()->route('user-home');

        return redirect()->route('login')
            ->with([
                'status' => 'danger',
                'title' => 'Error Login !!',
                'message' => 'Username or Password invalid'
            ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
