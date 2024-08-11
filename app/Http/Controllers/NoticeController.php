<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = [];
        $data['active_menu'] = 'customerList';
        $data['page_title'] = 'Notice';
        $notice = Notice::all();
        return view('backend.notice.notice', compact('data','notice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $notice = new Notice();
        $notice->title = $request->title;
        $notice->description = $request->description;
        $notice->save();
        return back()->with('message', 'Created Notice Successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $notice = Notice::find($id);
        $notice->title = $request->title;
        $notice->description = $request->description;
        $notice->save();
        return back()->with('message', 'Created Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Notice::find($id)->delete();
        return back()->with('message','Notice Deleted Sucessfully');
    }
}
