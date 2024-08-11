<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //contactList
    public function contactList()
    {
        $data = array();
        $data['active_menu'] = 'list_panel';
        $data['page_title'] = "Contact List";
        $contact = Contact::all();
        return view('backend.allList.contactList',compact('data','contact'));
    }
    //contactListDelete
    public function contactListDelete($id)
    {
        Contact::find($id)->delete();
        return back()->with('success','Contact List Deleted Successfully');
    }
}
