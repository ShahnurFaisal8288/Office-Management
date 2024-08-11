<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerApproveController extends Controller
{
    //customerApprove
    public function customerApprove()
    {
        $data = [];
        $data['active_menu'] = 'customersApprove';
        $data['page_title'] = 'Customers Approve';
        $customer = Customer::where('status','pending')->get();
        return view('backend.customer.approvedList',compact('customer','data'));
    }
}
