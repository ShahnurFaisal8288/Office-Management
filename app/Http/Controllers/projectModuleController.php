<?php

namespace App\Http\Controllers;

use App\Models\ProjectCreate;
use App\Models\ProjectModule;
use Illuminate\Http\Request;

class projectModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array();
        $data['active_menu'] = 'projectModule';
        $data['page_title'] = 'Create Project Module';
        $projectModule = ProjectModule::all();
        $project = ProjectCreate::all();
        return view('backend.projectModule.index', compact('data', 'projectModule','project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = array();
        $data['active_menu'] = 'projectModule';
        $data['page_title'] = 'Create Project Module';
        $project = ProjectCreate::all();
        return view('backend.projectModule.create', compact('data','project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $project = new ProjectCreate(); // Assuming ProjectCreate is your model
        $project->module_name = $request->module_name;
        $project->save();
    
        // Assuming you want to store additional module details
        foreach ($request->module_name as $index => $moduleName) {
            $module = new ProjectCreate(); // Replace with your Module model if different
            $module->project_id = $project->id;
            $module->module_name = $moduleName;
            $module->features = $request->features[$index];
            $module->details = $request->details[$index];
            $module->save();
        }
        return redirect('/projectModule')->with('message', 'ProjectModule Create Successfully');
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
        $data = array();
        $data['active_menu'] = 'projectModule';
        $data['page_title'] = 'Create Project Module';
        $project = ProjectCreate::all();
        $ProjectModule = ProjectModule::findOrFail($id);
        return view('backend.projectModule.edit', compact('data','project','ProjectModule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        foreach ($request->project_id as $key => $projects) {
            $ProjectModule = ProjectModule::findOrFail($id);
            $ProjectModule->project_id = $projects;
            $ProjectModule->module_name = $request->module_name[$key];
            $ProjectModule->features = $request->features[$key];
            $ProjectModule->details = $request->details[$key];
            $ProjectModule->save();
        }
        return redirect('/projectModule')->with('message', 'ProjectModule Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ProjectModule = ProjectModule::findOrFail($id);
        $ProjectModule->delete();
        return back()->with('message', 'ProjectModule Deleted Successfully');
    }
}
