<?php 

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\User;
use App\Report;
use App\Post;

class ReportController extends Controller
{
    public function index()
    {
        $repor = Report::get();
        $reports= $repor->map(function($report){
            return [
            'id' => $report->id,
            'reporter' => $report->reporter->username,
            'username' => $report->post->user->username,
            'created_at' => $report->created_at->toDateTimeString(),
            'reason' => $report->reason,
            'status' => $report->status
            ];
        });

        return view('admin/report')->with(['reports'=>$reports]);
    }   
}