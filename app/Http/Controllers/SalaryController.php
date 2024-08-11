<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Carbon\Carbon;
use Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    //salary
    public function salary()
    {
        $data = array();
        $data['active_menu'] = 'salaryAdd';
        $data['page_title'] = 'Add Salary';
        if (request()->isMethod('post')) {
            $salary = new Salary();
            $salary->employee_id = request('employee_id');
            $salary->deliverables = request('deliverables');
            $salary->amount = request('amount');
            $salary->remarks = request('remarks');
            $salary->save();
            return back()->with('message', 'Salary Added Successfully');
        }
        $currectMonth = now()->month();
        $from_date = Carbon::parse(request()->from_date)->startOfDay();
        $to_date = Carbon::parse(request()->to_date)->endOfDay();
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $salary = Salary::whereDate('created_at', '>=', $from_date)
                        ->whereDate('created_at', '<=', $to_date)
                        ->get();
        
        $employee = Employee::select('id', 'name', 'designation')->get();
        return view('backend.salary.addSalary', compact('data', 'employee', 'salary'));
    }
    public function salaryUpdate($id)
    {
        $salary = Salary::findOrFail($id);
        $salary->status = 'approve';
        $salary->save();
        return back()->with('message', 'Salary Status Updated Successfully');
    }
    //salarySheet
    public function salarySheet(){
        $data = array();
        $data['active_menu'] = 'salarySheet';
        $data['page_title'] = 'Salary Sheet';
        $salarySheet = Employee::with('salary')->get();
        $pdf = Pdf::loadView('backend.salary.salarySheet',compact('data','salarySheet'));
        return $pdf->stream('SalarySheet.pdf');
        // return view('backend.salary.salarySheet',compact('data','salarySheet'));
    }
    //employeeSalary
    public function employeeSalary(){
        $data = array();
        $data['active_menu'] = 'employeeSalary';
        $data['page_title'] = 'Employee Salary';
        $authId = Auth::guard('admin')->user()->id;
        $employee = Employee::where('AuthId', $authId)->first();
        $salary = Salary::where('employee_id',$employee->id)->where('status','pending')->get();
        return view('backend.salary.employeeSalary',compact('salary','data'));
    }
}
