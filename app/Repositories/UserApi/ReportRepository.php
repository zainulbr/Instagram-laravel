<?php
/**

 */

namespace App\Repositories\UserApi;


use App\Report;
use Illuminate\Http\Request;

class ReportRepository
{
    private $report;
    private $request;
    public function __construct(Request $request,Report $report)
    {
        $this->report = $report;
        $this->request = $request;
    }

    public function send()
    {
        $this->report->create([
            'post_id' => $this->request->input('report_post_id'),
            'reporter_id' => auth()->user()->id,
            'reason' => $this->request->input('report_reason')
        ]);

        return ['error' => false, 'message' => 'sukses menambah report', 'status' => 'success'];
    }
}