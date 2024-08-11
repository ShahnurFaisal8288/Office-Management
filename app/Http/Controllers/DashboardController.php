<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Batch;
use App\Models\CashInHand;
use App\Models\CoursePay;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Investor;
use App\Models\InvestorPay;
use App\Models\Invoice;
use App\Models\Maintenance;
use App\Models\MaintenancePay;
use App\Models\Notice;
use App\Models\Project;
use App\Models\Salary;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Claims\Custom;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data = array();
        $data['active_menu'] = 'dashboard';
        $data['page_title'] = 'Dashboard';
        $currentMonth = Carbon::now()->month;
        //total client
        $customer = Customer::count('id');
        //current_month_name
        $currentMonthName = now()->format('F');
        //PayableInCurrentMonth
        $payAmount = Invoice::whereMonth('created_at', $currentMonth)->sum('total_amount');
        $advance = Invoice::whereMonth('created_at', $currentMonth)->sum('advance');
        $maintenance = Maintenance::sum('maintenance_amount');
        $receivableCurrent =  $payAmount + $maintenance;
        $receivableTotal = Invoice::sum('total_amount');
        //IncomeInCurrentMonth
        $income = InvestorPay::with('invoices')->whereMonth('created_at', $currentMonth)->sum('total');
        $MaintenancePay = MaintenancePay::whereMonth('created_at', $currentMonth)->sum('amount');
        $incomeTotal = InvestorPay::sum('total');
        $advanceAll = Invoice::sum('advance');
        $incomeCurrent = $income + $advance + $MaintenancePay;
        $unpaidAmountCurrent = $receivableCurrent - $incomeCurrent;
        $incomeAll = $incomeTotal + $advanceAll + $maintenance;
        $dueCurrent = $receivableCurrent - $incomeCurrent;

        $dueTotal = $receivableTotal - $incomeAll;
        $task = Task::where('status', 'active')->where('progress_status', 'ongoing')->count();
        $completed = Task::where('progress_status', 'complete')->count();
        $taskInactive = Task::where('status', 'inactive')->count();
        $totalEmployee = Employee::count('id');
        $maintanenceCount = Customer::where('status', 'maintenance')->count();
        $invoice = Invoice::sum('advance');
        // $expense =  Expense::sum('amount');
        $invoicePay = InvestorPay::sum('total');
        $cashhand = CashInHand::sum('amount');
        $totalIncome = ($invoice ?? 0) + ($invoicePay ?? 0) + ($maintenance ?? 0) + ($cashhand ?? 0);
        // $cashInHand = $totalIncome - $expense;
        $auth = Auth::guard('admin')->user()->id;
        $employee = Employee::where('authId', $auth)->select('id')->first();
        
        if ($employee) {
            $currentDateTime = Carbon::now();
            $sevenDaysAgo = $currentDateTime->copy()->subDays(7);
            $lastWeek = $currentDateTime->subDays(10);
            $currentNotices = Notice::where('created_at', '>=', $lastWeek)->get();
            // $project = Project::with('projectModules')
            // attendance
            // $authId = Auth::guard('admin')->user()->id;
            // $employee = Employee::where('AuthId', $authId)->first();
            
            $currentDate = \Carbon\Carbon::now()->toDateString();

            if ($employee) {
                $attendance = Attendance::where('employee_id', $employee->id)
                    ->whereDate('created_at', $currentDate)
                    ->first();

                $currentMonthAttendance = Attendance::where('employee_id', $employee->id)
                    ->whereMonth('created_at', $currentMonth)
                    ->where('block_status', 'late')
                    ->count();
                if ($currentMonthAttendance >= 3) {
                    $blockCount = $currentMonthAttendance;
                }else{
                    $blockCount = null;
                }


                // Debug the entire collection
                // dd($currentMonthAttendance);
                if ($attendance) {
                    $attendanceStart = $attendance->checkin;
                    $attendanceIN = $attendance->status == 'start';
                    $attendanceEnd = $attendance->status == 'end';
                    $attendanceOut = $attendance->checkout;
                    $employeeId = $attendance->id;
                } else {
                    $attendanceIN = null;
                    $attendanceStart = null;
                    $attendanceEnd = null;
                    $attendanceOut = null;
                    $employeeId = null;
                    $blockEmployee = null;
                }
                return view('backend.dashboard.employeeDashboard', compact('data', 'attendanceStart', 'currentNotices', 'employeeId', 'attendanceIN', 'attendanceEnd', 'blockCount'));
            } else {
                $attendanceIN = null;
                $attendanceOut = null;
                $employeeId = null;
                $blockCount = null;
                $blockEmployee = null;
            }
            return view('backend.dashboard.employeeDashboard', compact('data', 'attendanceStart', 'currentNotices', 'employeeId', 'attendanceIN', 'attendanceEnd', 'blockCount'));
        }
        return view('backend.dashboard.dashboard', compact('data', 'customer', 'currentMonthName', 'receivableCurrent', 'incomeCurrent', 'dueCurrent', 'task', 'taskInactive', 'incomeTotal', 'dueTotal', 'totalEmployee', 'incomeAll', 'completed', 'maintanenceCount', 'unpaidAmountCurrent', 'totalIncome'));
    }
    //receivableCurrent
    public function receivableCurrent()
    {
        $data = array();
        $data['active_menu'] = 'dashboard';
        $data['page_title'] = 'Dashboard';
        $currentMonth = now()->month;
        $receivableCurrent = Invoice::whereMonth('created_at', $currentMonth)->get();
        return view('backend.dashboard.receivableCurrent', compact('data', 'receivableCurrent'));
    }
    //currentIncomeList
    public function currentIncomeList()
    {
        $data = array();
        $data['active_menu'] = 'dashboard';
        $data['page_title'] = 'Dashboard';
        $currentMonth = now()->month;
        $currentIncomeList = InvestorPay::with('invoices')->whereMonth('created_at', $currentMonth)->get();

        // $advance = Invoice::where('id',$currentIncomeList->invoice_id)->first();
        // dd($advance);
        return view('backend.dashboard.currentIncomeList', compact('data', 'currentIncomeList'));
    }
    //totalIncomeList
    public function totalIncomeList()
    {
        $data = array();
        $data['active_menu'] = 'dashboard';
        $data['page_title'] = 'Dashboard';
        $totalIncomeList = InvestorPay::with('invoices')->get();

        return view('backend.dashboard.totalIncomeList', compact('data', 'totalIncomeList'));
    }
    //activeProjectList
    public function activeProjectList()
    {
        $data = array();
        $data['active_menu'] = 'dashboard';
        $data['page_title'] = 'Dashboard';
        $activeProjectList = Task::where('status', 'active')->where('progress_status', 'ongoing')->get();


        return view('backend.dashboard.activeProjectList', compact('data', 'activeProjectList'));
    }
    //inactiveProjectList
    public function inactiveProjectList()
    {
        $data = array();
        $data['active_menu'] = 'dashboard';
        $data['page_title'] = 'Dashboard';
        $inactiveProjectList = Task::where('status', 'inactive')->get();
        return view('backend.dashboard.inactiveProjectList', compact('data', 'inactiveProjectList'));
    }
    //completedProjectList
    public function completedProjectList()
    {
        $data = array();
        $data['active_menu'] = 'dashboard';
        $data['page_title'] = 'Dashboard';
        $completedProjectList = Task::where('progress_status', 'complete')->get();
        return view('backend.dashboard.completedProjectList', compact('data', 'completedProjectList'));
    }
    //maintenanceList
    public function maintenanceList()
    {
        $data = array();
        $data['active_menu'] = 'dashboard';
        $data['page_title'] = 'Dashboard';
        $maintenance = Customer::where('status', 'maintenance')->get();
        return view('backend.dashboard.maintenanceList', compact('data', 'maintenance'));
    }
}
