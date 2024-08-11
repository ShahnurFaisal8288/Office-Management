<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Module;
use App\Models\ModuleProject;
use App\Models\Project;
use App\Models\ProjectCreate;
use App\Models\ProjectDetails;
use App\Models\ProjectModule;
use Illuminate\Http\Request;
use DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array();
        $data['active_menu'] = 'projectAssign';
        $data['page_title'] = 'Create Project';
        $project = Project::all();
        return view('backend.project.index', compact('data', 'project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = array();
        $data['active_menu'] = 'projectAssign';
        $data['page_title'] = 'Create Project';
        $module = ProjectModule::all();
        $employee = Employee::select('id', 'name')->get();
        $project = ProjectCreate::all();
        return view('backend.project.create', compact('data', 'module', 'employee', 'project'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $project = new Project();
        $project->projectCreate_id = $request->projectCreate_id;
        $project->save();

        $project_module_ids = $request->input('project_module_id', []);
        $hours = $request->input('hours', []);
        $featureses = $request->input('features', []); // This will be an array of arrays
        $detailses = $request->input('details', []);
        $employee_ids = $request->input('employee_id', []); // This will be an array of arrays

        foreach ($project_module_ids as $index => $moduleId) {
            $hour = $hours[$index] ?? null;
            $features = $featureses[$index] ?? [];
            $details = $detailses[$index] ?? null;
            $employees = $employee_ids[$index] ?? [];

            // Attach the module with the additional pivot data
            $project->modules()->attach($moduleId, [
                'project_id' => $project->id,
                'project_create_id' => $project->projectCreate_id,
                'hours' => $hour,
                'features' => json_encode($features), 
                'details' => $details,
                'employee_id' => json_encode($employees), 
            ]);
        }
        return redirect('/project')->with('message', 'Project Created Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = array();
        $data['active_menu'] = 'projectAssign';
        $data['page_title'] = 'Project Edit';
        $projectId = Project::findOrFail($id);
        $project = ProjectCreate::all();
        $projectModule = ProjectModule::all();
        $employee = Employee::select('id', 'name')->get();
        $proDetails = ProjectDetails::where('project_create_id', $projectId->projectCreate_id)->get();
        return view('backend.project.edit', compact('data', 'projectId', 'project', 'employee', 'proDetails','projectModule'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     $project = Project::findOrFail($id);
    //     $project->projectCreate_id = $request->projectCreate_id;
    //     $project->save();

    //     $project_module_ids = $request->input('project_module_id', []);
    //     $hours = $request->input('hours', []);
    //     $featureses = $request->input('features', []); // This will be an array of arrays
    //     $detailses = $request->input('details', []);
    //     $employee_ids = $request->input('employee_id', []); // This will be an array of arrays

    //     foreach ($project_module_ids as $index => $moduleId) {
    //         $hour = $hours[$index] ?? null;
    //         $features = $featureses[$index] ?? [];
    //         $details = $detailses[$index] ?? null;
    //         $employees = $employee_ids[$index] ?? [];

    //         // Attach the module with the additional pivot data
    //         $project->modules()->attach($moduleId, [
    //             'project_id' => $project->id,
    //             'project_create_id' => $project->projectCreate_id,
    //             'hours' => $hour,
    //             'features' => json_encode($features), 
    //             'details' => $details,
    //             'employee_id' => json_encode($employees), 
    //         ]);
    //     }
    //     return redirect('/project')->with('message', 'Project Updated Successfully');
    // }
    public function update(Request $request, string $id)
    {
        // Find the project by ID
        $project = Project::findOrFail($id);
    
        // Update the project with the new projectCreate_id
        $project->projectCreate_id = $request->projectCreate_id;
        $project->save();
    
        // Retrieve the inputs from the request
        $project_module_ids = $request->input('project_module_id', []);
        $hours = $request->input('hours', []);
        $featureses = $request->input('features', []); // This will be an array of arrays
        $detailses = $request->input('details', []);
        $employee_ids = $request->input('employee_id', []); // This will be an array of arrays
    
        foreach ($project_module_ids as $index => $moduleId) {
            $hour = $hours[$index] ?? null;
            $features = $featureses[$index] ?? [];
            $details = $detailses[$index] ?? null;
            $employees = $employee_ids[$index] ?? [];
    
            // Update or create a new ProjectDetails record
            ProjectDetails::updateOrCreate(
                [
                    'project_create_id' => $project->projectCreate_id,
                    'project_module_id' => $moduleId,
                ],
                [
                    'hours' => $hour,
                    'features' => json_encode($features), 
                    'details' => $details,
                    'employee_id' => json_encode($employees), 
                ]
            );
        }
    
        return redirect('/project')->with('message', 'Project Updated Successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        $projectDetails = ProjectDetails::where('project_id', $id)->get();
        foreach ($projectDetails as $detail) {
            $detail->delete();
        }
        return back()->with('message', 'Project Management Deleted Successfully');
    }
}
