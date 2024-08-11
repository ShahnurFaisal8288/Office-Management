<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\DomainHosting;
use App\Models\Hosting;
use Illuminate\Http\Request;

class DomainHostingController extends Controller
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
        $data['active_menu'] = 'domainHosting';
        $data['page_title'] = 'Assign Domain in Hosting';
        $domain = Domain::all();
        $hosting = Hosting::all();
        $domainHosting = DomainHosting::all();
        return view('backend.domainHosting.addDomainHosting',compact('hosting','data','domain','domainHosting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $domain = new DomainHosting();
        $domain->domain_id = $request->domain_id;
        $domain->hosting_id = $request->hosting_id;
        $domain->save();
        return back()->with('message','Domain Assign in Hosting Successfully');
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
        //
    }
}
