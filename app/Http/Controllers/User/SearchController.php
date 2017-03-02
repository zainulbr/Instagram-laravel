<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $username = $request->input('query');
        $result = User::where('username', $username)
            ->orWhere('username', 'like', '%'.$username.'%')
            ->get();

        return View('user/search', ['result' => $result, 'query' => $username]);
    }
}