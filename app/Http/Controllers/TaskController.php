<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Task;
use App\Models\TaskDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['active_menu'] = 'task_assign';
        $data['page_title'] = 'Task Assign';
        $task = Task::with(['taskDetails', 'employee', 'customer'])->get();

        $employee = Employee::all();
        $customer = Customer::all();
        $auth = Auth::guard('admin')->user()->id;
        $employees = Employee::where('authId', $auth)->first();
        if ($employees) {
            $task = Task::where('employee_id', $employees->authId)->get();
            return view('backend.task.task', compact('data', 'task', 'employee', 'customer'));
        }
        return view('backend.task.task', compact('data', 'task', 'employee', 'customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $titles = $request->title;
        // $employee_id = $request->employee_id;
        // $employeeExists = DB::table('employees')->where('authId', $employee_id)->first();
        // dd($titles, $employee_id,$employeeExists->id);
        $task = Task::create([
            'customer_id' => $request->customer_id,
            'description' => $request->description,
            // 'title' => $request->title,
            'employee_id' => $request->employee_id,
            'assign_date' => $request->assign_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);
        $titles = $request->title;
        $employee_id = $request->employee_id;

        // Validate employee_id exists in employees table
        $employeeExists = DB::table('employees')->where('authId', $employee_id)->first();

        if (!$employeeExists) {
            return back()->withErrors(['employee_id' => 'Invalid employee selected.'])->withInput();
        }
        foreach ($titles as $title) {
            TaskDetail::create([
                'task_id' => $task->id,
                'employee_id' => $employeeExists->id,
                'title' => $title,
            ]);
        }
        $customer = Customer::find($request->customer_id);
        $customer->status = 'ongoing';
        $customer->save();
        return back()->with('Task Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [];
        $data['active_menu'] = 'task_assign';
        $data['page_title'] = 'Task Assign';
        $task = Task::find($id);
        $employee = Employee::all();
        $customer = Customer::all();
        return view('backend.task.taskEdit', compact('employee', 'task', 'data','customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
        $task->update([
            'description' => $request->description,
            'employee_id' => $request->employee_id,
            'assign_date' => $request->assign_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);
    
     
        return back()->with('success', 'Task Updated Successfully');
    }
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        $task->delete();
        return back()->with('message', 'Task Deleted Successfully');
    }
    public function taskStatus($id)
    {
        $task = Task::find($id);
        if ($task->status == 'active') {
            $task->update([
                'status' => 'inactive',
            ]);
        } else {
            $task->update([
                'status' => 'active',
            ]);
        }
        return back()->with('message', 'Status Changed Successfully');
    }
    //taskProgressStatus
    public function taskProgressStatus($id)
    {
        $task = Task::find($id);
        $task->update([
            'progress_status' => 'complete',
        ]);
        $customer = Customer::where('id', $task->customer_id)->first();
        $customer->status = 'completed';
        $customer->save();
        return back()->with('message', 'Status Changed Successfully');
    }
    //maintenance
    public function maintenance($id)
    {
        $task = Task::find($id);
        $task->update([
            'progress_status' => 'maintenance',
        ]);
        $customer = Customer::where('id', $task->customer_id)->first();
        $customer->status = 'maintenance';
        $customer->save();
        return back()->with('message', 'Status Changed Successfully');
    }
}