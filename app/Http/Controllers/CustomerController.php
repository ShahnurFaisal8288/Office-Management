<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\InvestorPay;
use App\Models\Invoice;
use App\Models\Task;
use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['active_menu'] = 'customerList';
        $data['page_title'] = ' Customer List';
        $customer = Customer::whereNot('status','completed')->get();
        return view('backend.customer.orgList', compact('customer', 'data'));
        
    }
    //allCustomer
    public function allCustomerList(){
        $data = [];
        $data['active_menu'] = 'allCustomer';
        $data['page_title'] = ' All Customer List';
        $customer = Customer::where('status','completed')->get();
        return view('backend.customer.allCustomerList', compact('customer', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['active_menu'] = 'Customer';
        $data['page_title'] = 'Add Customer';
        return view('backend.customer.add_customer', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Customer::create([
            'name_or_business' => $request->name_or_business,
            'serial_number' => $request->serial_number,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return to_route('customerList')->with('message', 'Customer Created Successfully!!!');
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
        $data['active_menu'] = 'customerList';
        $data['page_title'] = 'Customer Report';
        $customer = Customer::find($id);
        return view('backend.customer.edit_customer', compact('data','customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customer::find($id);
        $customer->update([
            'name_or_business' => $request->name_or_business,
            'serial_number' => $request->serial_number,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return to_route('customerList')->with('message', 'Customer Updated Successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $customer = Customer::findOrFail($id);
        // $customer->delete();
        // return redirect()->route('customer.index')->with('message', 'Customer Deleted Successfully!!!');
    }
    //customerDelete
    public function customerDelete(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return back()->with('message', 'Customer Deleted Successfully!!!');
    }
    //customerList
    public function customerList()
    {
        $data = [];
        $data['active_menu'] = 'dashboard';
        $data['page_title'] = 'Dashboard';
        $customer = InvestorPay::with('customers', 'invoices')
            ->select(DB::raw('sum(total) as total_paid'), 'customer_id', 'invoice_id')
            ->groupBy('customer_id', 'invoice_id')
            ->get();

        // $invoice = Invoice::where('id',$customer->invoice_id)->first();
        // $mainAmount = $invoice->dueAmount;
        // $dueAmount =$mainAmount - $customer->total_paid;


        return view('backend.customer.list_customer', compact('data', 'customer'));
    }
    //maintenance
    public function maintenance($id)
    {
        $customer = Customer::find($id);
        $task = Task::where('progress_status', 'complete')->orWhere('customer_id', $customer->id)->first();
        
        if ($customer->status == 'pending') {
            if ($task->progress_status == 'complete') {
                $customer->update([
                    'status' => 'ongoing',
                ]);
            } else {
                // echo 'This project is not finished yet!';
                return back()->with('message', 'This project is not finished yet!');
            }
        } else {
            $customer->update([
                'status' => 'ongoing',
            ]);
        }
        return back()->with('message', 'Customer Status Changed Successfully');
    }
    //ongoing
    public function ongoing($id)
    {
        $customer = Customer::find($id);

        // $task = Task::where('progress_status','complete')->orWhere('customer_id',$customer->id)->first();
        if ($customer->status == 'pending') {

            $customer->update([
                'status' => 'approved',
            ]);
        } else {
            // echo 'This project is not finished yet!';
            return back()->with('message', 'This project is not finished yet!');
        }
        return back()->with('message', 'Customer Status Changed Successfully');
    }
}
