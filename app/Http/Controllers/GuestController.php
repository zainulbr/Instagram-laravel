<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class GuestController extends Controller
{
    public function login()
    {
        return view('single/login');
    }

    public function register()
    {
        return view('single/register');
    }
}
