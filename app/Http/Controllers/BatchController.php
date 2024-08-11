<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Event;
use App\Models\HighCourt;
use App\Models\LowerCourt;
use Illuminate\Http\Request;
use PDOException;

class BatchController extends Controller
{
    //batchCreate
    public function batchCreate(){
        $data = array();
        $data['active_menu'] = 'batch_panel';
        $data['page_title'] = 'Batch Create';
        $lowerCourt = LowerCourt::all();
        $highCourt = HighCourt::all();
        $course = Event::all();
        if(request()->isMethod('post')){
            try{
            //   dd(request()->all());
               Batch::create([
                   'lowerCourt_id' => request('lowerCourt_id'),
                   'highCourt_id' => request('highCourt_id'),
                   'time' => request('time'),
                   'course_id' => request('course_id'),
                   'batch_name' => request('batch_name'),
              ]);
              return to_route('batch.list')->with('success', 'Event Created Successfully');
            }catch(PDOException $e){
               return $e;
            }
           }
        return view('backend.batch.batchCreate',compact('data','lowerCourt','highCourt','course'));
    }
    //batchList
    public function batchList(){
        $data = array();
        $data['active_menu'] = 'batch_panel';
        $data['page_title'] = 'Batch List';
        $batch = Batch::all();
        return view('backend.batch.batchList',compact('data','batch'));
    }
    //batchEdit
    public function batchEdit($id){
        $data = array();
        $data['active_menu'] = 'batch_panel';
        $data['page_title'] = 'Batch List';
        $batch = Batch::find($id);
        $lowerCourt = LowerCourt::all();
        $highCourt = HighCourt::all();
        $event = Event::all();
        if(request()->isMethod('post')){
            try{

                $batch->update([
                   'lowerCourt_id' => request('lowerCourt_id'),
                   'highCourt_id' => request('highCourt_id'),
                   'time' => request('time'),
                   'course_id' => request('course_id'),
                   'batch_name' => request('batch_name'),
              ]);
              return redirect('/batch/list')->with('success', 'Event Updated Successfully');
            }catch(PDOException $e){
               return $e;
            }
           }
        return view('backend.batch.batchEdit',compact('data','batch','lowerCourt','highCourt','event'));

    }
    //batchDelete
    public function batchDelete($id){
         Batch::find($id)->delete();
        return redirect()->back()->with('success', 'Event Deleted Successfully');
    }
}
