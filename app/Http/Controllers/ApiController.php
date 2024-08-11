<?php

namespace App\Http\Controllers;

use App\Mail\UserVerification;
use App\Models\Contact;
use App\Models\Event;
use App\Models\RealEvent;
use App\Models\User;
use App\Models\Advocate;
use App\Models\Attendance;
use App\Models\Batch;
use App\Models\ContactInvestor;
use App\Models\CoursePay;
use App\Models\HighCourt;
use App\Models\ImageChuti;
use App\Models\LowerCourt;
use App\Models\Notice;
use App\Models\OurTeam;
use App\Models\Review;
use App\Models\UserEvent;
use App\Models\UserHigh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{
    //chutiImagePost
    public function chutiImagePost()
    {
        if (request()->hasFile('image')) {
            $extension = request()->file('image')->extension();
            $photo_name = "backend/chuti_image/" . uniqid() . '.' . $extension;
            request()->file('image')->move('backend/chuti_image/', $photo_name);
        } else {
            $photo_name = null;
        }
        $chutiImage = ImageChuti::create([
            'name' => request('name'),
            'image' => $photo_name,
        ]);
        return response()->json($chutiImage, 200);
    }

    //chutiImageGet
    public function chutiImageGet()
    {
        $image = ImageChuti::all();
        return response()->json($image, 200);
    }
    //contactPost
    public function contactPost()
    {
        $ContactInvestor = ContactInvestor::create([
            'email' => request('email'),
            'phone' => request('phone'),
            'subject' => request('subject'),
            'message' => request('message'),
        ]);
        return response()->json($ContactInvestor, 200);
    }
    //contactGet
    public function contactGet()
    {
        $contact = ContactInvestor::all();
        return response()->json($contact, 200);
    }
}
