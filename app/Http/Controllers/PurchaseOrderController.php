<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\PurchaseOrder;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use PDF;

class PurchaseOrderController extends Controller
{
    //purchaseOrder_create
    public function purchaseOrder_create(Request $request)
    {
     
        $data = array();
        $data['active_menu'] = 'orderCreate';
        $data['page_title'] = 'PO Create';
        $service = Service::all();
        $lastEstimate = PurchaseOrder::orderBy('id', 'desc')->first();
        // Start with a default serial number
        $serialNum = '#Icicle0001';

        if ($lastEstimate && $lastEstimate->estimate_no) {
            $numericPart = (int)substr($lastEstimate->estimate_no, 7); // Convert string to integer
            $serialPrefix = '#Icicle';
            $newNumericPart = $numericPart + 1;

            $paddedNumericPart = str_pad($newNumericPart, 4, '0', STR_PAD_LEFT); // Adjusted padding to 4

            $newSerialNum = $serialPrefix . $paddedNumericPart;

            $existingSerial = PurchaseOrder::where('estimate_no', $newSerialNum)->exists();

            while ($existingSerial) {
                $newNumericPart++;
                $paddedNumericPart = str_pad($newNumericPart, 4, '0', STR_PAD_LEFT); // Adjusted padding to 4

                $newSerialNum = $serialPrefix . $paddedNumericPart;
                $existingSerial = PurchaseOrder::where('estimate_no', $newSerialNum)->exists();
            }
            $serialNum = $newSerialNum;
        }
        if (request()->isMethod('post')) {
            $purchaseOrder = new PurchaseOrder();
            $purchaseOrder->from = $request->from;
            $purchaseOrder->to = $request->to;
            $purchaseOrder->email = $request->email;
            $purchaseOrder->total = $request->total;
            $purchaseOrder->purchaseOrder_no = $request->purchaseOrder_no;
            $purchaseOrder->terms_and_condition = $request->terms_and_condition;

            // Handle file upload for signature
            if ($request->hasFile('signature')) {
                // $signaturePath = $request->file('signature')->store('signatures');
                // $estimate->signature = $signaturePath;
                $extension = $request->file('signature')->getClientOriginalExtension();
                $fileName = 'backend/img/signature/'.uniqid().'.'.$extension;
                $request->file('signature')->move('backend/img/signature',$fileName);
                $purchaseOrder->signature = $fileName;
            }

            $purchaseOrder->save();

            $service_ids = $request->input('service_id');
            $descriptions = $request->input('description');
            $amounts = $request->input('amount');

            // Attach services with quantities and amounts to the transaction
            foreach ($service_ids as $index => $serviceId) {
                $description = $descriptions[$index];
                $amount = $amounts[$index];
                $purchaseOrder->purchaseOrderQuantities()->attach($serviceId, [
                    'amount' => $amount,
                    'description' => $description,
                ]);
            }
            
        // $inv = PurchaseOrder::all()->last()->id;
        // $invoiceData = PurchaseOrder::where('id', $inv)->first();

        // $services = $invoiceData->purchaseOrderQuantities;
        // // set_time_limit(1000);
        // $invoiceArray = ['invoice' => $invoiceData, 'services' => $services];
        // $pdf = PDF::loadView('backend.purchaseOrder.printPo', $invoiceArray);
        // $customer_id = request('customer_id');
        // $customer = Customer::where('id',$customer_id)->first();
        // $data = ['name' => $customer->name, 'email' => $customer->email];
        // Mail::send('email.invoiceMail', $data, function ($message) use ($data, $pdf) {
        //     $message->from('qrcode950@gmail.com', 'Admin');
        //     $message->to($data['email'], $data['name'])
        //         ->cc(['shihabicicle@gmail.com','support@iciclecrm.icicle.dev'])
        //         ->subject('PO Created')
        //         ->attachData($pdf->output(), "po.pdf");
        // });
            return back()->with('message', 'Purchase Order Created');
        }
        return view('backend.purchaseOrder.create_purchaseOrder', compact('data','serialNum','service'));
    }
    public function purchaseOrderList()
    {
        $data = array();
        $data['active_menu'] = 'purchaseOrderList';
        $data['page_title'] = 'PO List';
        $purchaseOrder = PurchaseOrder::all();
        return view('backend.purchaseOrder.purchaseOrderList',compact('purchaseOrder','data'));
    }
    public function purchaseOrdereDestroy($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $signature = $purchaseOrder->signature;
        if(File::exists($signature)){
            File::delete($signature);
        }
        $purchaseOrder->delete();
        return back()->with('message','Purchase Order Deleted Successfully');
    }
    public function purchaseOrderView($id)
    {
        $purchaseOrder = PurchaseOrder::find($id);
        $services = $purchaseOrder->purchaseOrderQuantities;
        // dd($purchaseOrder);

        return view('backend.purchaseOrder.viewPO',compact('purchaseOrder','services'));
    }
}
