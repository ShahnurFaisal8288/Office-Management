<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Permission;
use App\Models\SubModule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class RolePermissionController extends Controller
{
    //permission
    public function permission()
    {
        //        if (Auth::guard('admin')->user()->can('view-permission')) {
        $data = array();
        $data['active_menu'] = 'permission';
        $data['page_title'] = 'Add Permission';
        $permission = Permission::latest()->get();
        return view('backend.permission.permission', compact('permission','data'));
        //        }
        //        abort(403, 'Unauthorized action.');

    }
    //addPermission
    public function addPermission()
    {
        $data = array();
        $data['active_menu'] = 'permission';
        $data['page_title'] = 'Add Permission';
        $module = Module::latest()->get();
        $subModule = SubModule::latest()->get();
        return view('backend.permission.add-permission', compact('module', 'subModule','data'));
    }
    //storePermission
    //storePermission
    public function storePermission(Request $request)
    {
        $request->validate([
            'permission_name' => 'required'
        ]);
        $permission = new Permission();
        $permission->module_id = $request->module_id;
        $permission->sub_module_id = $request->sub_module_id;
        $permission->permission_name = $request->permission_name;
        $permission->slug = Str::slug($request->permission_name);
        $permission->created_by = Auth::guard('admin')->user()->id;
        $permission->save();
        return redirect('/permission')->with('message', 'Permission Add Successfully');
    }

    //editPermission
    public function editPermission($id)
    {
        $data = array();
        $data['active_menu'] = 'role';
        $data['page_title'] = 'Add Role';
        $permission = Permission::find($id);
        $module = Module::latest()->get();
        $subModule = SubModule::latest()->get();
        return view('backend.permission.edit-permission', compact('permission', 'module', 'subModule','data'));
    }
    //updatePermission
    public function updatePermission(Request $request)
    {
        $request->validate([
            'permission_name' => 'required'
        ]);
        $permission = Permission::find($request->permission_id);
        $permission->module_id = $request->module_id;
        $permission->sub_module_id = $request->sub_module_id;
        $permission->permission_name = $request->permission_name;
        $permission->slug = Str::slug($request->name, '-');
        $permission->created_by = Auth::guard('admin')->user()->id;
        $permission->save();
        return redirect('/permission')->with('message', 'Permission Updated Successfully');
    }
    //deletePermission
    public function deletePermission($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return back()->with('message', 'Permission Deleted Successfully');
    }
}
