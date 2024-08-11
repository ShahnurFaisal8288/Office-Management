<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //service
        $data = [];
        $data['active_menu'] = 'service';
        $data['page_title'] = 'List of Service';
        $service = Service::all();
        return view('backend.service.list_service', compact('data','service'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['active_menu'] = 'Customer';
        $data['page_title'] = 'Add Customer';
        return view('backend.service.add_service', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'name' => $request->name,
        ]);
        return back()->with('message','Service Created Successfully');
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $service = Service::find($id)
    }
}
