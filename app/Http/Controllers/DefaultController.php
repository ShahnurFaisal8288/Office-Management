<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Batch;
use App\Models\CoursePay;
use App\Models\Event;
use App\Models\UserEvent;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    //userGet
    public function userGet()
    {
        $event_id = request()->event_id;
        $event = UserEvent::where('event_id',$event_id)->where('status','false')->get();
        $html = '<option value="">Select An User</option>';
        foreach ($event as $events) {
            $html .= '<option value="'.$events->id.'">'.$events->user->name ?? '-'.'</option>';
        }
        return response()->json($html);
    }
    public function getAttendanceData($eventId)
    {
        $attendanceData = Attendance::where('event_id', $eventId)->with('user')->get();
        return response()->json($attendanceData);
    }
    public function getUserData(Request $request)
    {
    //     $eventSelect = $request->event;

    // // Fetch the package details based on ID
    // $attendance = Attendance::where('event_id', $eventSelect)->get();

    // // Return the package details as JSON
    // return response()->json($eventSelect);

        $eventSelect = $request->eventtt;


        // Fetch the attendance data based on the selected event
        $attendanceData = Attendance::where('event_id', $eventSelect)->get();

        // Return the attendance data as JSON
        return response()->json($eventSelect);
    }
    //getCost
    public function getCost(){
        $course_id = request()->course_id;
        $event = Event::where('id', $course_id)->first();
        $cost = $event ? $event->cost : '';
        return response()->json($cost);
    }

    //getlowerCource
    public function getlowerCource(){
        $course_id = request()->lower_id;
        $event = Event::where('lowerCourt_id',$course_id)->get();
        $html = '<option value="">Select Course</option>';
        foreach ($event as $events) {
            $html .= '<option value="'.$events->id.'">'.$events->title ?? '-'.'</option>';
        }
        return response()->json($html);
    }
    //getHighCource
    public function getHighCource(){
        $high_id = request()->high_id;
        $event = Event::where('highCourt_id',$high_id)->get();
        $html = '<option value="">Select Course</option>';
        foreach ($event as $events) {
            $html .= '<option value="'.$events->id.'">'.$events->title ?? '-'.'</option>';
        }
        return response()->json($html);
    }
    //getCourses
    public function getCourses(){
        $course_id = request()->course_id;
        $event = Batch::where('course_id',$course_id)->get();
        $html = '<option value="">Select Batch</option>';
        foreach ($event as $events) {
            $html .= '<option value="'.$events->id.'">'.$events->batch_name ?? '-'.'</option>';
        }
        return response()->json($html);
    }
    //geTableData
    public function geTableData(Request $request){
        $batch_id = $request->batch_id;
        $events = CoursePay::where('batch_id', $batch_id)->get();
        $events = $events->map(function ($event) {
            $event->delete_route = route('coursePay_delete', $event->id);
            return $event;
        });
        return response()->json($events);
    }

}
