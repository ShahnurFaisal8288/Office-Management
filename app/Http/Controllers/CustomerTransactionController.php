<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerTransactionController extends Controller
{
    //index
    public function index(Request $request){
        Customer::create([
            'name_or_business' => $request->name_or_business,
            'serial_number' => $request->serial_number,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return to_route('transaction.create')->with('message', 'Customer Created Successfully!!!');
    }
}
