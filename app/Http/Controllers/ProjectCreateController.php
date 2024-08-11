<?php

namespace App\Http\Controllers;

use App\Models\ProjectCreate;
use App\Models\ProjectModule;
use Illuminate\Http\Request;

class ProjectCreateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array();
        $data['active_menu'] = 'project';
        $data['page_title'] = 'Create Project';
        $project = ProjectCreate::all();
        return view('backend.projectCreate.index',compact('data','project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required'
        ]);
        $formattedStartDate = \Carbon\Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
        $formattedEndDate = \Carbon\Carbon::parse($request->end_date)->format('Y-m-d H:i:s');
        $Project = new ProjectCreate();
        $Project->project_name = $request->project_name;
        $Project->hour = $request->hour;
        $Project->start_date = $formattedStartDate;
        $Project->end_date = $formattedEndDate;
        $Project->save();
        return back()->with('message', 'Project Create Successfully');
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
        $request->validate([
            'project_name' => 'required'
        ]);
        $Project = ProjectCreate::findOrFail($id);
        $Project->project_name = $request->project_name;
        $Project->module_name = $request->module_name;
        $Project->start_date = $request->start_date;
        $Project->end_date = $request->end_date;
        $Project->hour = $request->hour;
        $Project->save();
        return back()->with('message', 'Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Project = ProjectCreate::findOrFail($id);
        $Project->delete();
        return back()->with('message', 'Project Deleted Successfully');
    }
    //projectDetasils
   
}
