<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use App\Models\UpdateTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskUpdateController extends Controller
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
        $data['active_menu'] = 'task_update';
        $data['page_title'] = 'Task Update';
        $task = Task::where('taskStatus', 'pending')->get();


        $auth = Auth::guard('admin')->user()->id;
        $taskUpdate = UpdateTask::all();

        $employees = Employee::where('authId', $auth)->first();
        if ($employees) {
            $task = Task::where('employee_id', $employees->authId)->where('taskStatus', 'pending')->get();
            $taskUpdate = UpdateTask::where('employee_id', $employees->authId)->get();

            return view('backend.task.taskUpdate', compact('data', 'task','taskUpdate'));
        }
        return view('backend.task.taskUpdate', compact('data', 'task','taskUpdate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $auth = Auth::guard('admin')->user()->id;
        UpdateTask::create([
            'task_id' => request('task_id'),
            'description' => request('description'),
            'employee_id' => $auth,
            'taskStatus' => request('taskStatus'),
        ]);
        $task = Task::find(request('task_id'));
        $task->taskStatus = request('taskStatus');
        $task->save();

        return back()->with('message', 'Task Updated Successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
