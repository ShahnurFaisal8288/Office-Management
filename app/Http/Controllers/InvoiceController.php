<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['active_menu'] = 'invoice';
        $data['page_title'] = 'List of Invoice';
        $invoices = Invoice::all();
        foreach ($invoices as $invoice) {
            $invoice->formatted_date = Carbon::parse($invoice->created_at)->format('d-M-Y');
            $invoice->due_date = Carbon::parse($invoice->payment_due_date)->format('d-M-Y');
        }
        return view('backend.invoice.list_invoice', compact('data', 'invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //InvoiceCreate
        $data = [];
        $data['active_menu'] = 'InvoiceCreate';
        $data['page_title'] = 'Add Invoice';
        $customer = Customer::all();
        $service = Service::all();

        return view('backend.invoice.add_invoice', compact('data', 'customer', 'service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
        ]);
        $invoice = Invoice::create([
            'customer_id' => request('customer_id'),
            'po_so_number' => request('po_so_number'),
            'invoice_date' => request('invoice_date'),
            'payment_due_date' => request('payment_due_date'),
            'total_amount' => request('total_amount'),
            'discount' => request('discount'),
            'disWith_total_amount' => request('disWith_total_amount'),
            'invoice_no' => request('invoice_no'),
            'advance' => request('advance'),
            'payment_type' => request('payment_type'),
            'dueAmount' => request('dueAmount'),
            'paid' => request('paid'),
            'due' => request('due'),
        ]);
        $serviceIds = $request->input('service_id');
        $quantities = $request->input('quantity');
        $amounts = $request->input('amount');
        $descriptions = $request->input('description');

        // Attach services with quantities and amounts to the transaction
        foreach ($serviceIds as $index => $serviceId) {
            $quantity = $quantities[$index];
            $amount = $amounts[$index];
            $description = $descriptions[$index];

            $invoice->services()->attach($serviceId, [
                'quantity' => $quantity,
                'amount' => $amount,
                'description' => $description,
            ]);
        }
        // $inv = Invoice::all()->last()->id;
        // $invoiceData = Invoice::where('id', $inv)->first();

        // $services = $invoiceData->services;
        // // set_time_limit(1000);
        // $invoiceArray = ['invoice' => $invoiceData, 'services' => $services];
        // $pdf = PDF::loadView('backend.invoice.printInvoice', $invoiceArray);
        // $customer_id = request('customer_id');
        // $customer = Customer::where('id',$customer_id)->first();
        // $data = ['name' => $customer->name, 'email' => $customer->email];
        // Mail::send('email.invoiceMail', $data, function ($message) use ($data, $pdf) {
        //     $message->from('qrcode950@gmail.com', 'Admin');
        //     $message->to($data['email'], $data['name'])
        //         ->cc(['shihabicicle@gmail.com','support@iciclecrm.icicle.dev'])
        //         ->subject('Invoice Created')
        //         ->attachData($pdf->output(), "invoice.pdf");
        // });
        return to_route('invoice.index')->with('message', 'Invoice Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::find($id);
        $services = $invoice->services;
        return view('backend.invoice.show_invoice', compact('invoice', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [];
        $data['active_menu'] = 'invoice';
        $data['page_title'] = 'List of Invoice';
        $invoices = Invoice::with('services')->find($id);
        $customer = Customer::all();
        $service = Service::all();


        return view('backend.invoice.edit_invoice', compact('data', 'invoices', 'customer', 'service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoices = Invoice::with('services')->find($id);

        $newAdvance = $request->advance;
        $newTotalAdvance = $invoices->advance + $newAdvance;
        $newDueAmount = $invoices->dueAmount - $newAdvance;




        $invoices->advance= $newTotalAdvance;
        $invoices->dueAmount= $newDueAmount;
        $invoices->customer_id= $request->customer_id;
        $invoices->po_so_number= $request->po_so_number;
        $invoices->invoice_date= $request->invoice_date;
        $invoices->payment_due_date= $request->payment_due_date;
        $invoices->discount= $request->discount;
        $invoices->disWith_total_amount= $request->disWith_total_amount;
        $invoices->save();
        $invoices->services()->detach();
        $serviceIds = $request->input('service_id');
        $quantities = $request->input('quantity');
        $amounts = $request->input('amount');
        $descriptions = $request->input('description');
        // Attach services with quantities and amounts to the transaction
        foreach ($serviceIds as $index => $serviceId) {
            $quantity = $quantities[$index];
            $amount = $amounts[$index];
            $description = $descriptions[$index];

            $invoices->services()->attach($serviceId, [
                'quantity' => $quantity,
                'amount' => $amount,
                'description' => $description,
            ]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return redirect()->route('invoice.index')->with('message', 'Invoice Deleted Successfully!!!');
    }
}
