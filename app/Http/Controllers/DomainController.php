<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
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
        $data['active_menu'] = 'add_domain';
        $data['page_title'] = 'Add Domain';
        $domain = Domain::all();
        return view('backend.domain.addDomain',compact('domain','data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $domain = new Domain();
        $domain->domainName = $request->domainName;
        $domain->credentials = $request->credentials;
        $domain->startDate = $request->startDate;
        $domain->endDate = $request->endDate;
        $domain->save();
        return back()->with('message','Domain Added Successfully');
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
        $data['active_menu'] = 'add_domain';
        $data['page_title'] = 'Edit Domain';
        $domain = Domain::find($id);
        return view('backend.domain.editDomain',compact('domain','data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $domain = Domain::find($id);
        $domain->domainName = request()->domainName;
        $domain->startDate = request()->startDate;
        $domain->endDate = request()->endDate;
        $domain->save();
        return to_route('domain.create')->with('message','Domain Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Domain::find($id)->delete();
        return back()->with('message','Domain Deleted Successfully');
    }
}
