<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AuthAdmin;
use App\Models\Admin;
use App\Models\AdminAuth;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\TeamLeader;

class CreateAdminController extends Controller
{
    public function adminList()
    {
        $data = array();
        $data['active_menu'] = 'adminList';
        $data['page_title'] = 'Employee List';

        $list = AdminAuth::latest()->get();
        return view('backend.createAdmin.adminList', compact('list', 'data'));
    }


    public function createAdmin()
    {
        $data = array();
        $data['active_menu'] = 'adminCreate';
        $data['page_title'] = 'Admin Create';
        $adminCreate = Role::all();

        return view('backend.createAdmin.createAdmin', compact('adminCreate', 'data'));
    }

    public function adminCreate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admin_auths,email',
            'password' => 'required',
            'user_role' => 'required',
        ]);
        $admin = AdminAuth::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'user_role' => request('user_role'),
        ]);
        $admin->roles()->attach(request('user_role'));
        $authAdminId = AdminAuth::all()->last()->id;

        if ((request('user_role') == '6' || request('user_role') == '3')) {
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->extension();
                $imageName = "backend/img/employee/" . uniqid() . '_' . $extension;
                $request->file('image')->move('backend/img/employee', $imageName);
            } else {
                $imageName = null;
            }
            if ($request->hasFile('nid')) {
                $extension = $request->file('nid')->extension();
                $nidFile = "backend/img/nid/" . uniqid() . '_' . $extension;
                $request->file('nid')->move('backend/img/nid', $nidFile);
            } else {
                $nidFile = null;
            }
            Employee::create([
                'name' => $request->name,
                'AuthId' => $authAdminId,
                'email' => $request->email,
                'phone' => $request->phone,
                'nid' =>$nidFile,
                'emergency_phone' => $request->emergency_phone,
                'relationToEmergency' => $request->relationToEmergency,
                'address' => $request->address,
                'blood_group' => $request->blood_group,
                'profession_type' => $request->profession_type,
                'intern_duration' => $request->intern_duration,
                'pay_agreement' => $request->pay_agreement,
                'joining_date' => $request->joining_date,
                'image' => $imageName,
                'designation' => $request->designation,
                'last_increment_date' => $request->last_increment_date,
            ]);
        }
        return to_route('adminList');
    }
    public function showEditAdmin($id)
    {
        $data = array();
        $data['active_menu'] = 'adminEdit';
        $data['page_title'] = 'Admin Edit';
        $adminCreate = Role::get();
        $test = AdminAuth::find($id);
        $name = $test->name;

        $employee = Employee::where('name', $name)->first();
        return view('backend.createAdmin.editAdmin', compact('test', 'adminCreate', 'data', 'employee'));
    }

    public function editAdmin(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'user_role' => 'required',
        ]);
    
        $admin = AdminAuth::find($id);
    
        $adminData = [
            'name' => $request->name,
            'email' => $request->email,
            'user_role' => $request->user_role,
        ];
    
        if ($request->filled('password')) {
            $adminData['password'] = bcrypt($request->password);
        }
    
        $admin->update($adminData);
    
        $employee = Employee::where('authId', $id)->first();
    
        if ($employee) {
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->extension();
                $imageName = "backend/img/employee/" . uniqid() . '.' . $extension;
                $request->file('image')->move('backend/img/employee', $imageName);
                $employee->image = $imageName;
            }
    
            if ($request->hasFile('nid')) {
                $extension = $request->file('nid')->extension();
                $nidFile = "backend/img/nid/" . uniqid() . '.' . $extension;
                $request->file('nid')->move('backend/img/nid', $nidFile);
                $employee->nid = $nidFile;
            }
    
            $employee->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'emergency_phone' => $request->emergency_phone,
                'relationToEmergency' => $request->relationToEmergency,
                'address' => $request->address,
                'blood_group' => $request->blood_group,
                'profession_type' => $request->profession_type,
                'intern_duration' => $request->intern_duration,
                'pay_agreement' => $request->pay_agreement,
                'joining_date' => $request->joining_date,
                'designation' => $request->designation,
            ]);
        }
        return redirect()->route('adminList');
    }
    public function deleteAdmin($id)
    {
        $adminAuth = AdminAuth::findOrFail($id);
        $employee = Employee::where('authId',$id);
        $employee->delete();
        $adminAuth->delete();
        return redirect()->back();
    }
}