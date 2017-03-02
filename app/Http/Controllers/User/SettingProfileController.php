<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingProfileController extends Controller
{
    public function index()
    {
        return View('user/change_profile');
    }

    public function save(Request $request)
    {
        $email = $request->input('email');
        $full_name = $request->input('full_name');
        $birthdate = $request->input('birthdate');
        $status_message = $request->input('status_message');

        $update = auth()->user()->update([
            'email' => $email,
            'full_name' => $full_name,
            'birthdate' => $birthdate,
            'status_message' => $status_message
        ]);
        return redirect()->route('user-profile-edit')
            ->with(['status' => 'success', 'title' => 'Success!!', 'message' => 'Your Profile Updated!!']);
    }
}