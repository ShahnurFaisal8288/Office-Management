<?php

namespace App\Http\Controllers;

use App\Models\AdminAuth;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Expr\Empty_;



class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = [];
        $data['active_menu'] = 'add_employee';
        $data['page_title'] = 'Add Employee';
        $employee = Employee::all();
        $adminCreate = Role::all();

        return view('backend.employee.employeeList', compact('employee', 'data','adminCreate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        AdminAuth::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'user_role' => request('user_role'),
        ]);
        // $admin->roles()->attach(request('user_role'));
        $authAdminId = AdminAuth::all()->last()->id;

        if ((request('user_role') == '6')) {
            if ($request->hasFile('image')) {
                $extension = $request->file('image')->extension();
                $imageName = "backend/img/employee/" . uniqid() . '_' . $extension;
                $request->file('image')->move('backend/img/employee', $imageName);
            } else {
                $imageName = null;
            }
            Employee::create([
                'name' => $request->name,
                'authId' => $authAdminId,
                'email' => $request->email,
                'phone' => $request->phone,
                'emergency_phone' => $request->emergency_phone,
                'address' => $request->address,
                'blood_group' => $request->blood_group,
                'profession_type' => $request->profession_type,
                'intern_duration' => $request->intern_duration,
                'pay_agreement' => $request->pay_agreement,
                'joining_date' => $request->joining_date,
                'image' => $imageName,
                'designation' => $request->designation,
                // 'authId' => $authAdminId,
            ]);
        }
        return back()->with('message', 'Employee Created Successfully');
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
        $data['active_menu'] = 'add_employee';
        $data['page_title'] = ' Edit Invoice';
        $employee = Employee::find($id);

        return view('backend.employee.employeeEdit', compact('employee', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $employee = Employee::find($id);
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->extension();
            $imageName = "backend/img/employee/" . uniqid() . '.' . $extension;
            $request->file('image')->move('backend/img/employee', $imageName);
            if(File::exists($employee->image)){
                File::delete($employee->image);
            }
        } else {
            $imageName = $employee->image;
        }



        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'emergency_phone' => $request->emergency_phone,
            'address' => $request->address,
            'blood_group' => $request->blood_group,
            'profession_type' => $request->profession_type,
            'intern_duration' => $request->intern_duration,
            'pay_agreement' => $request->pay_agreement,
            'joining_date' => $request->joining_date,
            'image' => $imageName,
            'designation' => $request->designation,
            // 'city' => $request->city,
        ]);

        return back()->with('message', 'Employee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            // Get the image filename
            $image = $employee->image;

            // Construct the full path of the image file
            $imagePath = public_path('backend/backend/img/employee/') . $image;

            // Check if the image file exists
            if (File::exists($imagePath)) {
                // Delete the image file
                File::delete($imagePath);
            }

            // Delete the employee record
            $employee->delete();

            // Redirect back or to a specified route after deletion
            return redirect()->back()->with('success', 'Employee deleted successfully');
        } else {
            // If employee is not found, redirect back or to a specified route with an error message
            return redirect()->back()->with('error', 'Employee not found');
        }
    }

}
