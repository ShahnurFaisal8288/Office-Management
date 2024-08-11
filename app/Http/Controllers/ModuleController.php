<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    //module
    public function module()
    {
        $data = array();
        $data['active_menu'] = 'module';
        $data['page_title'] = 'Add Module';
        $module = Module::latest()->get();
        return view('backend.module.module', compact('module', 'data'));
    }

    // add module
    public function addModule()
    {
        $data = array();
        $data['active_menu'] = 'module';
        $data['page_title'] = 'Add Module';
        return view('backend.module.add-module', compact('data'));
    }
    // store module
    public function storeModule(Request $request)
    {
        $request->validate([
            'module_name' => 'required|max:200|unique:modules'
        ]);
        $module = new Module();
        $module->module_name = $request->module_name;
        $module->slug = Str::slug($request->module_name, '-');
        $module->save();
        return redirect('/module')->with('message', 'Module Add Successfully');
    }
    // edit module
    public function editModule($id)
    {

        $module = Module::find($id);
        $data = array();
        $data['active_menu'] = 'module';
        $data['page_title'] = 'Add Module';
        return view('backend.module.edit-module', compact('module','data'));
    }

    // update module

    public function updateModule(Request $request)
    {
        $request->validate([
            'module_name' => 'required|max:200'
        ]);
        $module = Module::find($request->module_id);
        $module->module_name = $request->module_name;
        $module->slug = Str::slug($request->module_name, '-');
        $module->save();
        return redirect('/module')->with('message', 'Module Updated Successfully');
    }
    // delete module
    public function deleteModule($id)
    {

        $module = Module::find($id);
        $module->delete();
        return back()->with('message', 'Module Deleted Successfully');
    }
}
