<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ApplicationController extends Controller
{
    //application_index
    public function application_index()
    {
        $data = array();
        $data['active_menu'] = 'add_application';
        $data['page_title'] = 'Add Application';
        $application = Application::all();
        $auth = Auth::guard('admin')->user()->id;
        $emplyoee = Employee::where('authId', $auth)->first();
        if($emplyoee){
            $application = Application::where('employee_id',$emplyoee->authId)->get();
        // dd($application);
            
            return view('backend.application.applicationList',compact('data','application'));
        }
        return view('backend.application.applicationList',compact('data','application'));
    }
    //application_create
    public function application_create()
    {
        $data = array();
        $data['active_menu'] = 'add_application';
        $data['page_title'] = 'Add Application';
        $employee = Employee::all();

        if(request()->isMethod('post')){
            if(request()->hasFile('image')){
                $extension = request()->file('image')->getClientOriginalExtension();
                $fileName = 'backend/img/application/'.uniqid().'.'.$extension;
                request()->file('image')->move('backend/img/application',$fileName);
               
            }
            $auth = Auth::guard('admin')->user()->id;
            $application = new Application();
            $application->application_type = request()->application_type;
            $application->employee_id = $auth;
            $application->application_body	= request()->application_body;
            $application->subject = request()->subject;
            $application->from_date = request()->from_date;
            $application->to_date = request()->to_date;
            if(request()->hasFile('image')){
                $application->image = $fileName;
            }
            $application->save();
            
            return to_route('application.index')->with('message','Application Created Successfully');
        }
        return view('backend.application.applicationCreate',compact('data','employee'));
    }
    //applicationDestroy
    public function applicationDestroy($id){
        $application = Application::find($id);
        $file = $application->image;
        if(File::exists($file)){
            File::delete($file);
        }
        $application->delete();
        return back()->with('message','Application Deleted Successfully');
    }
    //approveList
    public function approveList(){
        $data = array();
        $data['active_menu'] = 'approveList';
        $data['page_title'] = 'Add Application';
        $application = Application::where('status','pending')->get();
        return view('backend.application.approveList',compact('application','data'));
    }
    //applicationStatus
    public function applicationStatus($id)
    {
        $application = Application::findOrFail($id);
        $application->status = 'approved';
        $application->save();
        return back()->with('message','Application Approved Successfully');
    }
}
