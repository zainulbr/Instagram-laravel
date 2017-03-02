<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository {

    private $request;
    private $user;

    public function __construct(Request $request, User $user)
    {
        $this->user  = $user;
        $this->request = $request;
    }

    public function login()
    {
        $username = $this->request->input('username');
        $password = $this->request->input('password');

        if($username == '' && $username == null) return ['error' => true, 'message' => 'Username Cannot Empty'];
        if($password == '' && $password == null) return ['error' => true, 'message' => 'Password Cannot Empty'];

        $auth = $this->user->where('username', $username)->firstOrFail();

        if(!$auth){
            return ['error' => true, 'message'=>'Username not registered'];
        }

        if(!Hash::check($password, $auth->password)){
            return ['error' => true, 'message' => 'Wrong Password!!'];
        }

        $auth->generateToken();
        return ['error' => false, 'data'=>$auth];

    }

    public function register()
    {
        $username = $this->request->input('username');
        $password = $this->request->input('password');
        $email = $this->request->input('email');
        $full_name = $this->request->input('full_name');
        $birthdate = $this->request->input('birthdate');
        
        if($username == '' && $username == null) return ['error' => true, 'message' => 'Username Cannot Empty'];
        if($password == '' && $password == null) return ['error' => true, 'message' => 'Password Cannot Empty'];
        if($email == '' && $email == null) return ['error' => true, 'message' => 'Email Cannot Empty'];
        if($full_name == '' && $full_name == null) return ['error' => true, 'message' => 'Full Name Cannot Empty'];
        if($birthdate == '' && $birthdate == null) return ['error' => true, 'message' => 'Birth Date Cannot Empty'];
        if(!$this->check_username($username)) return ['error' => true, 'message' => 'Username has been Registered'];

        $new_user = $this->user->create([
            'username' => $username,
            'password' => bcrypt($password),
            'email' => $email,
            'full_name' => $full_name,
            'birthdate' => $birthdate,
        ]);

        return ['error' => false, 'message'=>'Register Success. Lets Login!!'];
    }

    private function check_username($username)
    {
        return $this->user->where('username', $username)->count() >= 1;
    }
}