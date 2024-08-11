<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\UserEvent;
use Illuminate\Http\Request;
use PDOException;
use App\Image;
use App\Models\HighCourt;
use App\Models\LowerCourt;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class EventController extends Controller
{
    public function event()
    {
        $data = array();
        $data['active_menu'] = 'Event';
        $data['page_title'] = 'Course List';
        $event = Event::all();
        return view('backend.event.eventList',compact('event','data'));
    }
    public function eventCreate()
    {
        $data = array();
        $data['active_menu'] = 'Event';
        $data['page_title'] = 'Course Create';
        $event = Event::select('status')->get();
        
        if(request()->isMethod('post')){
            try{
               if(request()->hasFile('image')){
                   $extension = request()->file('image')->extension();
                   $photo_name= "backend/img/events/".uniqid().'.'.$extension;
                   request()->file('image')->move('backend/img/events', $photo_name);
               }else{
                   $photo_name = null;
               }
               Event::create([
                   'title' => request('title'),
                   'image' => $photo_name,
                   'description' => request('description'),
                   'cost' => request('cost'),
                   'start_date' => request('start_date'),
                   'days' => request('days'),
                   'lowerCourt_id' => request('lowerCourt_id'),
                   'highCourt_id' => request('highCourt_id'),
              ]);
              return redirect()->back()->with('success', 'Event Created Successfully');
            }catch(PDOException $e){
               return $e;
            }
           }
           $lowerCourt = LowerCourt::all();
           $highCourt = HighCourt::all();
        return view('backend.event.eventCreate',compact('data','event','lowerCourt','highCourt'));

    }
    //event_user
    public function event_user()
    {
        $data = array();
        $data['active_menu'] = 'Event';
        $data['page_title'] = 'Course User';
        $userEvent = UserEvent::all();

        return view('backend.event.event_user',compact('data','userEvent'));
    }
    //event_delete
    public function event_delete($id)
    {
        Event::find($id)->delete();
        return back()->with('success', 'Event Removed Successfully');
    }
    //eventEdit
    public function eventEdit($id){
        $data = array();
        $data['active_menu'] = 'Event_User';
        $data['page_title'] = 'Course Edit';
        $event = Event::find($id);
        if(request()->isMethod('post')){
            try{

               if(request()->hasFile('image')){
                   $extension = request()->file('image')->extension();
                   $photo_name= "backend/img/events/".uniqid().'.'.$extension;
                   request()->file('image')->move('backend/img/events', $photo_name);
               }else{
                // request()->image =  (new Image)->dirName('package')->file('image')
                // ->resizeImage(500, 500)
                // ->save();
               }
               if(request()->hasFile('image')){
                $event->update([
                    'title' => request('title'),
                    'image' => $photo_name,
                    'description' => request('description'),
                    'cost' => request('cost'),
                    'start_date' => request('start_date'),
                    'days' => request('days'),
                    'lowerCourt_id' => request('lowerCourt_id'),
                   'highCourt_id' => request('highCourt_id'),

               ]);
               }else{
                $event->update([
                    'title' => request('title'),
                    // 'image' => $photo_name,
                    'description' => request('description'),
                    'cost' => request('cost'),
                    'start_date' => request('start_date'),
                    'days' => request('days'),


               ]);
               }

              return redirect()->back()->with('success', 'Event Created Successfully');
            }catch(PDOException $e){
                return redirect()->back()->with('error', 'Failed Please Try Again');
            }
           }
           $lowerCourt = LowerCourt::all();
           $highCourt = HighCourt::all();
           return view('backend.event.eventEdit',compact('event','data','lowerCourt','highCourt'));
    }
}
