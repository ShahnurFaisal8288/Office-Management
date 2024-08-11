<?php

namespace App\Http\Controllers;

use App\Models\AdminAuth;
use App\Models\Attendance;
use App\Models\Batch;
use App\Models\BatchAttendance;
use App\Models\CoursePay;
use App\Models\Employee;
use App\Models\Event;
use App\Models\UnblockEmployee;
use App\Models\User;
use App\Models\UserEvent;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use PDOException;

class AttendanceController extends Controller
{
    //Attendance
    public function Attendance()
    {
        $data = array();
        $data['active_menu'] = 'addAttendance';
        $data['page_title'] = 'Attendance List';

        $authId = Auth::guard('admin')->user()->id;
        $employee = Employee::where('AuthId', $authId)->first();

        $currentDate = \Carbon\Carbon::now()->toDateString();
        if ($employee) {
            $attendance = Attendance::where('employee_id', $employee->id)
                ->whereDate('created_at', $currentDate)
                ->first();

            if ($attendance) {
                $attendanceIN = $attendance->checkin;
                $attendanceOut = $attendance->checkout;
                $employeeId = $attendance->id;
            } else {
                $attendanceIN = null;
                $attendanceOut = null;
                $employeeId = null;
            }
            $attendanceList = Attendance::all();
            $emloyeeList = Employee::all();
            return view('backend.attendance.attendanceList', compact('data', 'attendanceIN', 'employeeId', 'attendanceOut', 'attendanceList', 'emloyeeList'));
        } else {
            $attendanceIN = null;
            $attendanceOut = null;
            $employeeId = null;
        }

        $attendanceList = Attendance::all();
        $emloyeeList = Employee::all();
        return view('backend.attendance.attendanceList', compact('data', 'attendanceIN', 'employeeId', 'attendanceOut', 'attendanceList', 'emloyeeList'));
    }
    //getAttendance
    public function getAttendance()
    {
        $authId = Auth::guard('admin')->user()->id;

        // Fetching the employee
        $employee = Employee::where('AuthId', $authId)->first();

        if ($employee) {
            // Setting timezone to Asia/Dhaka
            Carbon::setLocale('en');
            $current_time_bd = Carbon::now()->setTimezone('Asia/Dhaka');

            // Creating and saving the attendance record
            DB::beginTransaction();
            $attendance = new Attendance();
            $attendance->employee_id = $employee->id;
            $attendance->checkin = $current_time_bd;
            $attendance->status = 'start';
            $specified_time = Carbon::createFromTime(10, 0, 0); // 10:00 am
            if ($specified_time->greaterThan($current_time_bd)) {
                // dd($specified_time);
                $attendance->block_status = 'late';
            }
            $attendance->save();

            DB::commit();

            return back()->with('message', 'Attendance Successful');
        } else {
            return back()->with('error', 'Employee not found');
        }
    }
    //endAttendance
    public function endAttendance($id)
    {

        Carbon::setLocale('en');
        $current_time_bd = Carbon::now()->setTimezone('Asia/Dhaka');
        DB::beginTransaction();
        $attendance = Attendance::find($id);
        $attendance->checkout = $current_time_bd;
        $attendance->status = 'start';
        $attendance->save();

        DB::commit();

        return back()->with('message', 'Attendance Out Successful');
    }
    //editAttendance
    public function updateAttendance($id)
    {
        $authId = Auth::guard('admin')->user()->id;

        // Fetching the employee
        $employee = Employee::where('AuthId', $authId)->first();

        if ($employee) {
            // Setting timezone to Asia/Dhaka
            Carbon::setLocale('en');
            $current_time_bd = Carbon::now()->setTimezone('Asia/Dhaka');

            // Creating and saving the attendance record
            DB::beginTransaction();
            $attendance = Attendance::find($id);
            $attendance->employee_id = request('employee_id');
            $attendance->checkin = request('checkin');
            $attendance->checkout = request('checkout');
            $attendance->save();

            DB::commit();

            return back()->with('message', 'Attendance Successful');
        } else {
            return back()->with('error', 'Employee not found');
        }
    }
    //createAttendance
    public function createAttendance()
    {
        $attendance = new Attendance();
        $attendance->employee_id = request('employee_id');
        $attendance->checkin = request('checkin');
        $attendance->checkout = request('checkout');
        $attendance->save();
        return back()->with('message', 'Attendance Created Successful');
    }
    //unblockEmployee
    public function unblockEmployee()
    {
        $data = array();
        $data['active_menu'] = 'unblockEmployee';
        $data['page_title'] = 'Unblock Employee';
        $currentMonth = Carbon::now()->month;
        $blockEmployees =  Attendance::select('employee_id')
            ->whereMonth('created_at', $currentMonth)
            ->where('block_status', 'late')
            ->groupBy('employee_id')
            ->havingRaw('COUNT(employee_id) >= 3')
            ->get();
        $unblockEmployee = UnblockEmployee::all();

        return view('backend.attendance.unblockEmployee', compact('data', 'blockEmployees','unblockEmployee'));
    }
    //unblockEmployeePost
    public function unblockEmployeePost()
    {
        $blockEmployee = new UnblockEmployee();
        $blockEmployee->employee_id = request('employee_id');
        $blockEmployee->status = request('status');
        $blockEmployee->save();
        $attendance = Attendance::where('employee_id', request('employee_id'))->get();
        foreach ($attendance as $record) {
            $record->block_status = request('status');
            $record->save();
        }
        return back()->with('message', 'Employee Status Changed Successfully');
    }
    //deleteUnblock 
    public function deleteUnblock($id){
        UnblockEmployee::find($id)->delete(); 
        return back()->with('message', 'Unblock Data Deleted Successfully');
    }
}
