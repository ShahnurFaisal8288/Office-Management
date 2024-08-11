<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\BatchAttendance;
use App\Models\CoursePay;
use App\Models\Event;
use App\Models\StudentCost;
use App\Models\User;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use PDF;

class CoursePayController extends Controller
{
    //coursePay
    public function coursePay()
    {
        $data = array();
        $data['active_menu'] = 'course_Pay';
        $data['page_title'] = 'Create Course Pay';
        $user = User::select('id', 'phone','serial_number')->get();
        $course = Event::select('id', 'title')->get();
        $batch = Batch::select('id', 'batch_name')->get();
        if (request()->isMethod('post')) {
            CoursePay::create([
                'student_id' => request()->student_id,
                'course_id' => request()->course_id,
                'admissionCost' => request()->admissionCost,
                'month' => request()->month,
                'batch_id' => request()->batch_id,
                'cost' => request()->cost,
                'paid_amount' => request()->paid_amount,
                'due_amount' => request()->due_amount,
            ]);
            
            $userCost = StudentCost::where('student_id', request()->student_id)->first();
            $BatchAttendance = BatchAttendance::where('student_id', request()->student_id)->first();
            if (!$BatchAttendance) {
                $BatchAttendance = new BatchAttendance();
                $BatchAttendance->student_id = request()->student_id;
                $BatchAttendance->batch_id = request()->batch_id; 
                $BatchAttendance->save();
            } else {
             
            }
            if (!$userCost) {
                $userCost = new StudentCost();
                $userCost->student_id = request()->student_id;
                $userCost->student_cost = request()->cost; 
                $userCost->save();
            } else {
             
            }
                    
            return redirect()->back()->with('success', 'Course Pay Created Successfully');
        }
        
        return view('backend.coursePay.create_pay', compact('data', 'user', 'course', 'batch'));
    }

    //courseList
    public function courseList()
    {
        $data = array();
        $data['active_menu'] = 'course_Pay';
        $data['page_title'] = 'Course Pay List';
        $coursePay = CoursePay::all();
        return view('backend.coursePay.create_pay_list', compact('data', 'coursePay'));
    }
    //course_print
    public function course_print($id)
    {
        $data = array();
        $data['active_menu'] = 'course_Pay';
        $coursePay = CoursePay::find($id);
        if ($coursePay) {
            $studentId = $coursePay->student_id;
            $studentCourses = CoursePay::where('student_id', $studentId)->get();
        }
        return view('backend.coursePay.print_pay', compact('data','studentCourses','coursePay'));
    }
    //course_edit
    public function course_edit($id)
    {
        $coursePay = CoursePay::find($id);
        $data = array();
        $data['active_menu'] = 'course_Pay';
        $data['page_title'] = 'Course Pay  Edit';
        $user = User::select('id', 'phone')->get();
        $course = Event::select('id', 'title')->get();
        $batch = Batch::select('id', 'batch_name')->get();
        if (request()->isMethod('post')) {
            $coursePay->update([
                'student_id' => request()->student_id,
                'course_id' => request()->course_id,
                'admissionCost' => request()->admissionCost,
                'month' => request()->month,
                'batch_id' => request()->batch_id,
                'cost' => request()->cost,
                'paid_amount' => request()->paid_amount,
                'due_amount' => request()->due_amount,
            ]);
            return redirect()->back()->with('success', 'Course Pay Updated Successfully');
        }
        return view('backend.coursePay.edit_pay', compact('coursePay', 'data', 'user', 'course', 'batch'));
    }
    //coursePay_delete
    public function coursePay_delete($id)
    {
        CoursePay::find($id)->delete();
        return back()->with('success', 'Course Pay Deleted Successfully');
    }
    //coursePdf
    public function coursePdf($id)
    {
        $coursePay = CoursePay::find($id);
        if ($coursePay) {
            $studentId = $coursePay->student_id;
            $studentCourses = CoursePay::where('student_id', $studentId)->get();
        }
        $data = [
            'title' => 'welcome to FerozLaw',
            'date' => date('m/d/Y'),
            'coursePay' => $coursePay,
        ];
        $pdf = PDF::loadView('myPdf', compact('data', 'coursePay','studentCourses'));
        return $pdf->download('coursePay.pdf');
    }
}
