<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\CoursePay;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //studentReport
    public function studentReport()
    {
        $data = array();
        $data['active_menu'] = 'report';
        $data['page_title'] = 'Report List';

        $batch = Batch::all();

        $coursePay = CoursePay::with('batch', 'user', 'course');

        if (request()->has('batch_id') && request()->has('from_date')) {
            $date = request('from_date');
            try {
                $fromDate = Carbon::parse($date)->format('Y-m-d');
            } catch (\Exception $e) {
                return $e;
            }

            $coursePay->whereDate('created_at', '=', $fromDate);

            if (request()->has('batch_id')) {
                $coursePay->where('batch_id', request('batch_id'));
            }
        }

        $coursePayResults = $coursePay->get();

        return view('backend.report.studentReport', compact('data', 'batch', 'coursePayResults'));

    }
    public function studentDeuReport()
{
    $data = array();
    $data['active_menu'] = 'report';
    $data['page_title'] = 'Report List';

    $batch = Batch::all();

    $coursePay = CoursePay::with('batch', 'user', 'course');

    if (request()->has('batch_id') && request()->has('from_date') && request()->has('to_date')) {
        $fromDate = request('from_date');
        $toDate = request('to_date');

        try {
            $fromDate = Carbon::parse($fromDate)->format('Y-m-d');
            $toDate = Carbon::parse($toDate)->format('Y-m-d');
        } catch (\Exception $e) {
            return $e;
        }

        $coursePay->whereBetween('created_at', [$fromDate, $toDate]);

        if (request()->has('batch_id')) {
            $coursePay->where('batch_id', request('batch_id'));
        }
    }
    $coursePay->where('due_amount', '>', 0);
    $coursePayResults = $coursePay->get();

    return view('backend.report.studentDueReport', compact('data', 'batch', 'coursePayResults'));
}

}
