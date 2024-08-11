<?php

namespace App\Http\Controllers;

use App\Models\Hosting;
use Illuminate\Http\Request;

class HostingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['active_menu'] = 'add_hosting';
        $data['page_title'] = 'Add Hosting';
        $hosting = Hosting::all();
        return view('backend.hosting.addHosting',compact('hosting','data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hosting = new Hosting();
        $hosting->hostingName = $request->hostingName;
        $hosting->startDate = $request->startDate;
        $hosting->endDate = $request->endDate;
        $hosting->save();
        return back()->with('message','Hosting Added Successfully');
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
        $data = [];
        $data['active_menu'] = 'add_hosting';
        $data['page_title'] = 'Edit Hosting';
        $hosting = Hosting::find($id);
        return view('backend.hosting.editHosting',compact('hosting','data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hosting = Hosting::find($id);
        $hosting->hostingName = request()->hostingName;
        $hosting->startDate = request()->startDate;
        $hosting->endDate = request()->endDate;
        $hosting->save();
        return to_route('hosting.create')->with('message','Hosting Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Hosting::find($id)->delete();
        return back()->with('message','Hosting Deleted Successfully');
    }
}
