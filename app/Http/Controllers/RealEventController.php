<?php

namespace App\Http\Controllers;

use App\Models\RealEvent;
use Illuminate\Http\Request;
use PDOException;

class RealEventController extends Controller
{
    //realEventCreate
    public function realEventCreate(){
        $data = array();
        $data['active_menu'] = 'realEvent';
        $data['page_title'] = 'Event Create';
        // $event = Event::all();
        if(request()->isMethod('post')){
            try{

                $images = [];
               if(request()->hasFile('image')){
                   $extension = request()->file('image')->extension();
                   $photo_name= "backend/img/events/".uniqid().'.'.$extension;
                   request()->file('image')->move('backend/img/events', $photo_name);
               }else{
                // request()->image =  (new Image)->dirName('package')->file('image')
                // ->resizeImage(500, 500)
                // ->save();
               }
               if ($files = request()->file('memoriesImage')) {

                foreach ($files as $file) {

                    $extension = $file->getClientOriginalExtension();
                    $photoName = "backend/img/events/" . uniqid() . '.' . $extension;
                    $file->move('backend/img/events', $photoName);

                    // Save image name to the array
                    $images[] = $photoName;
                }
            }
            $realEvent = new RealEvent();
            $realEvent->title = request('title');
            if (request()->hasFile('image')) {
                $realEvent->image = $photo_name;
            }
            if (request()->file('memoriesImage')) {
                $realEvent->memoriesImage = json_encode($images);
            }
            $realEvent->description = request('description');
            $realEvent->cost = request('cost');
            $realEvent->start_date = request('start_date');
            $realEvent->end_date = request('end_date');
            $realEvent->video = request('video');
            $realEvent->venue = request('venue');
            $realEvent->type = request('type');
            $realEvent->save();
              return redirect('/RealEvent')->with('success', 'Event Created Successfully');
            }catch(PDOException $e){
               return $e;
            }
           }
        return view('backend.RealEvent.RealEventCreate',compact('data'));
    }
    //RealEvent
    public function RealEvent(){
        $data = array();
        $data['active_menu'] = 'realEvent';
        $data['page_title'] = 'Event List';
        $realEvent = RealEvent::all();

        return view('backend.RealEvent.RealEventList',compact('realEvent','data'));
    }
    //releventEdit
    public function releventEdit($id){
        $realEvent = RealEvent::find($id);
        $data = array();
        $data['active_menu'] = 'realEvent';
        $data['page_title'] = 'Event List';
        if(request()->isMethod('post')){
            try{

                $images = [];
               if(request()->hasFile('image')){
                   $extension = request()->file('image')->extension();
                   $photo_name= "backend/img/events/".uniqid().'.'.$extension;
                   request()->file('image')->move('backend/img/events', $photo_name);
               }else{
                // request()->image =  (new Image)->dirName('package')->file('image')
                // ->resizeImage(500, 500)
                // ->save();
               }
               if ($files = request()->file('memoriesImage')) {

                foreach ($files as $file) {

                    $extension = $file->getClientOriginalExtension();
                    $photoName = "backend/img/events/" . uniqid() . '.' . $extension;
                    $file->move('backend/img/events', $photoName);

                    // Save image name to the array
                    $images[] = $photoName;
                }
            }
            $realEvent->title = request('title');
            if (request()->hasFile('image')) {
                $realEvent->image = $photo_name;
            }
            if (request()->file('memoriesImage')) {
                $realEvent->memoriesImage = json_encode($images);
            }
            $realEvent->description = request('description');
            $realEvent->cost = request('cost');
            $realEvent->start_date = request('start_date');
            $realEvent->video = request('video');
            $realEvent->end_date = request('end_date');
            $realEvent->venue = request('venue');
            $realEvent->type = request('type');
            $realEvent->save();
              return redirect('/RealEvent')->with('success', 'Event Created Successfully');
            }catch(PDOException $e){
               return $e;
            }
           }
        return view('backend.RealEvent.RealEventEdit',compact('realEvent','data'));
    }
    //realEventDelete
    public function realEventDelete($id){
        $realEvent = RealEvent::find($id);
        $realEvent->delete();
        return back()->with('success', 'Event Deleted Successfully');

    }
    //disableStatus
    public function disableStatus($id)
    {
        $realEvent = RealEvent::find($id);
        $realEvent->status =  'inactive';
        $realEvent->save();
        return back()->with('success', 'Event Disable Successfully');
    }
    //enableStatus
    public function enableStatus($id)
    {
        $realEvent = RealEvent::find($id);
        $realEvent->status =  'active';
        $realEvent->save();
        return back()->with('success', 'Event enable Successfully');
    }
}
