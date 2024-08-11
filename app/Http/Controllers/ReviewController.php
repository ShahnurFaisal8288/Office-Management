<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{   
    //reviewList
    public Function reviewList()
    {
        $data = array();
        $data['active_menu'] = 'list_panel';
        $data['page_title'] = "Review List";
        $review = Review::all();
        return view('backend.allList.reviewList',compact('data','review'));
    }
    //ReviewDelete
    public function reviewListDeleted($id)
    {
        Review::find($id)->delete();
        return back()->with('success','Review Deleted Successfully');
    }
}
