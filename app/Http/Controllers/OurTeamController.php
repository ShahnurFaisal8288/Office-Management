<?php

namespace App\Http\Controllers;

use App\Models\OurTeam;
use Illuminate\Http\Request;
use PDOException;

class OurTeamController extends Controller
{
    public function ourTeamCreate()
    {
        $data = array();
        $data['active_menu'] = 'ourTeam';
        $data['page_title'] = 'Our Team';
        if (request()->isMethod('post')) {
            try{
                if(request()->hasFile('image')){
                    $extension = request()->file('image')->extension();
                    $photo_name= "backend/img/ourTeam/".uniqid().'.'.$extension;
                    request()->file('image')->move('backend/img/ourTeam', $photo_name);
                }else{
                    $photo_name = null;
                }
                OurTeam::create([
                    'name' => request('name'),
                    'image' => $photo_name,
                    'designation' => request('designation'),

               ]);
               return redirect()->back()->with('success', 'Event Created Successfully');
             }catch(PDOException $e){
                return $e;
             }
            }

        return view('backend.ourTeam.ourTeam_add',compact('data'));
    }
    public function ourTeamList(){
        $data = array();
        $data['active_menu'] = 'ourTeam';
        $data['page_title'] = 'Our Team';
        $ourTeam = OurTeam::all();
        return view('backend.ourTeam.ourTeam_list',compact('data','ourTeam'));
    }
    public function ourTeamEdit($id)
    {
        $data = array();
        $data['active_menu'] = 'ourTeam';
        $data['page_title'] = 'Our Team';
        $ourTeam = OurTeam::find($id);
        if(request()->isMethod('post')){
            try{
                if(request()->hasFile('image')){
                    $extension = request()->file('image')->extension();
                    $photo_name= "backend/img/ourTeam/".uniqid().'.'.$extension;
                    request()->file('image')->move('backend/img/ourTeam', $photo_name);
                }else{
                    $photo_name = null;
                }
                $ourTeam->update([
                    'name' => request('name'),
                    'image' => $photo_name,
                    'designation' => request('designation'),

               ]);
               return redirect()->back()->with('success', 'Event Updated Successfully');
             }catch(PDOException $e){
                return $e;
             }


        }
        return view('backend.ourTeam.ourTeam_Edit',compact('ourTeam','data'));
    }
    //ourTeamDelete
    public function ourTeamDelete($id)
    {
        $data = array();
        $data['active_menu'] = 'ourTeam';
        $data['page_title'] = 'Our Team';
        OurTeam::find($id)->delete();
        return redirect()->back()->with('success', 'Event Deleted Successfully');
    }
}
