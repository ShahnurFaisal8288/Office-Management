<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['active_menu'] = 'transaction';
        $data['page_title'] = 'List of Transaction';
        $transaction = Transaction::all();
        return view('backend.transaction.list_transaction', compact('data','transaction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        $data['active_menu'] = 'TransactionCreate';
        $data['page_title'] = 'Add Transaction';
        $customer = Customer::all();
        $service = Service::all();

        return view('backend.transaction.add_transaction', compact('data', 'customer', 'service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $transaction = Transaction::create([
            'customer_id' => request('customer_id'),
            'po_so_number' => request('po_so_number'),
            'transaction_date' => request('transaction_date'),
            'payment_due_date' => request('payment_due_date'),
            'total_amount' => request('total_amount'),
        ]);
        $serviceIds = $request->input('service_id');
        $quantities = $request->input('quantity');
        $amounts = $request->input('amount');

        // Attach services with quantities and amounts to the transaction
        foreach ($serviceIds as $index => $serviceId) {
            $quantity = $quantities[$index];
            $amount = $amounts[$index];

            $transaction->services()->attach($serviceId, [
                'quantity' => $quantity,
                'amount' => $amount,
            ]);
        }
        return back()->with('message', 'Transaction Created Successfully');
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
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return redirect()->route('transaction.index')->with('message', 'Customer Deleted Successfully!!!');
    }
}
