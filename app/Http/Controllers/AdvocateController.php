<?php

namespace App\Http\Controllers;

use App\Models\Advocate;
use App\Models\LowerCourt;
use Illuminate\Http\Request;
use PDOException;

class AdvocateController extends Controller
{
    //advocateCreate
    public function advocateCreate(Request $request){

        $data = array();
        $data['active_menu'] = 'advocate';
        $data['page_title'] = 'Advocate Create';
        if (request()->isMethod('post')) {
            try{
                $request->validate([
                    'name'=>'required',
                    'phone'=>'required|unique:advocates,phone',
                ]);
                  $advocate = new Advocate();
                  $advocate->name = $request->name;
                  $advocate->phone = $request->phone;
                  $advocate->work_place = $request->work_place;
                  if ($request->file('image')) {
                    $advocate->image = $this->makeImage($request);
                  }
                  $advocate->save();
                  return redirect('/advocate/list')->with('success', 'Advocated Created Successfully');
                }catch(PDOException $e){
                   return $e;
                }
               }
        return view('backend.advocate.create',compact('data'));
    }
    //makeImage($request)
    private function makeImage($request){
        $image = $request->file('image');
        $imageName = rand().'.'.$image->getClientOriginalExtension();
        $directory = public_path('backend/assets/advocate-image/');
        $path = 'backend/assets/advocate-image/';
        $imageUrl = $path . $imageName;
        $image->move($directory, $imageName);
        return $imageUrl;
    }
    //advocateList
    public function advocateList(){
        $data = array();
        $data['active_menu'] = 'advocate';
        $data['page_title'] = 'Advocate List';
        $advocate = Advocate::all();
        return view('backend.advocate.list',compact('data','advocate'));
    }
    //advocateEdit
    public function advocateEdit(Request $request,$id){
        $data = array();
        $data['active_menu'] = 'advocate';
        $data['page_title'] = 'Advocate Create';
        $advocate = Advocate::find($id);
        if (request()->isMethod('post')) {
            try{
                $advocate = Advocate::find($id);
                  $advocate->name = $request->name;
                  $advocate->phone = $request->phone;
                  $advocate->work_place = $request->work_place;
                  if ($request->file('image')) {
                    $advocate->image = $this->makeImage($request);
                  }
                  $advocate->save();
                  return redirect('/advocate/list')->with('success', 'Advocated Updated Successfully');
                }catch(PDOException $e){
                   return $e;
                }
               }
        return view('backend.advocate.edit',compact('data','advocate'));
    }
    //advocateDelete
     public function advocateDelete($id){
         Advocate::find($id)->delete();
         return back()->with('success', 'Advocated Deleted Successfully');
     }
}
