<?php

namespace App\Http\Controllers;

use App\Models\ProjectCreate;
use App\Models\ProjectDetails;
use App\Models\ProjectModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectFeatureController extends Controller
{
    public function projectDetails(Request $request,$id)
    {
        $project = ProjectCreate::find($id);
        $data = array();
        $data['active_menu'] = 'project';
        $data['page_title'] = 'Project Details';
        return view('backend.projectCreate.projectDetasils', compact('data', 'project'));
    }
    public function storeProjectDetails(Request $request)
    {
        foreach ($request->module_name as $index => $moduleName) {
            // Create a new ProjectDetail instance
            $projectDetail = new ProjectModule();
            $projectDetail->project_id = $request->project_id;
            $projectDetail->module_name = $moduleName;
            $projectDetail->features = $request->features[$index] ?? json_encode([]); // Default to empty JSON array
            $projectDetail->details = $request->details[$index] ?? '';
            $projectDetail->save();
        }
    
        // Redirect or return response
        return redirect()->route('projectCreate.index')->with('success', 'Project details added successfully.');
    }
    //showProjectDetails
    public function showProjectDetails($id){
        
    }
    
}
