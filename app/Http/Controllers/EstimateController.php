<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Estimate;
use App\Models\EstimateItem;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use PDF;

class EstimateController extends Controller
{
    //estimate_create
    public function estimate_create(Request $request)
    {
        $data = array();
        $data['active_menu'] = 'Estimate';
        $data['page_title'] = 'Estimate Create';
        $service = Service::all();
        $lastEstimate = Estimate::orderBy('id', 'desc')->first();

        // Start with a default serial number
        $serialNum = '#Icicle0001';

        if ($lastEstimate && $lastEstimate->estimate_no) {
            $numericPart = (int)substr($lastEstimate->estimate_no, 7); // Convert string to integer
            $serialPrefix = '#Icicle';
            $newNumericPart = $numericPart + 1;

            $paddedNumericPart = str_pad($newNumericPart, 4, '0', STR_PAD_LEFT); // Adjusted padding to 4

            $newSerialNum = $serialPrefix . $paddedNumericPart;

            $existingSerial = Estimate::where('estimate_no', $newSerialNum)->exists();

            while ($existingSerial) {
                $newNumericPart++;
                $paddedNumericPart = str_pad($newNumericPart, 4, '0', STR_PAD_LEFT); // Adjusted padding to 4

                $newSerialNum = $serialPrefix . $paddedNumericPart;
                $existingSerial = Estimate::where('estimate_no', $newSerialNum)->exists();
            }
            $serialNum = $newSerialNum;
        }
        if (request()->isMethod('post')) {
            $estimate = new Estimate();
            $estimate->from = $request->from;
            $estimate->to = $request->to;
            $estimate->email = $request->email;
            $estimate->total = $request->total;
            $estimate->estimate_no = $request->estimate_no;
            $estimate->terms_and_condition = $request->terms_and_condition;

            // Handle file upload for signature
            if ($request->hasFile('signature')) {
                // $signaturePath = $request->file('signature')->store('signatures');
                // $estimate->signature = $signaturePath;
                $extension = $request->file('signature')->getClientOriginalExtension();
                $fileName = 'backend/img/signature/'.uniqid().'.'.$extension;
                $request->file('signature')->move('backend/img/signature',$fileName);
                $estimate->signature = $fileName;
            }

            $estimate->save();

            $service_ids = $request->input('service_id');
            $descriptions = $request->input('description');

            $amounts = $request->input('amount');

            // Attach services with quantities and amounts to the transaction
            foreach ($service_ids as $index => $serviceId) {
                $description = $descriptions[$index];
                $amount = $amounts[$index];
                $estimate->services()->attach($serviceId, [
                    'amount' => $amount,
                    'description' => $description,
                ]);
            }
            // $est = Estimate::all()->last()->id;
            // $estimateData = Estimate::where('id', $est)->first();

            // $services = $estimateData->services;
            // // set_time_limit(1000);
            // $estimateArray = ['estimate' => $estimateData, 'services' => $services];
            // $pdf = PDF::loadView('backend.estimate.printEstimate', $estimateArray);
            // $customer_id = request('email');

            // $data = ['email' => $customer_id];
            // Mail::send('email.estimateMail', $data, function ($message) use ($data, $pdf) {
            //     $message->from('qrcode950@gmail.com', 'Admin');
            //     $message->to($data['email'])
            //         ->cc(['shihabicicle@gmail.com', 'support@iciclecrm.icicle.dev'])
            //         ->subject('Estimate Created')
            //         ->attachData($pdf->output(), "estimate.pdf");
            // });
            return to_route('estimateList')->with('message', 'Estimate Created');
        }
        return view('backend.estimate.create_estimate', compact('data', 'service','serialNum'));
    }
    //estimateList
    public function estimateList()
    {
        $data = array();
        $data['active_menu'] = 'estimateList';
        $data['page_title'] = 'Estimate List';
        $estimate = Estimate::all();
        return view('backend.estimate.estimateList',compact('estimate','data'));
    }
    //estimateDestroy
    public function estimateDestroy($id)
    {
        $estimate = Estimate::findOrFail($id);
        $signature = $estimate->signature;
        if(File::exists($signature)){
            File::delete($signature);
        }
        $estimate->delete();
        return back()->with('message','Estimate Deleted Successfully');
    }
    public function estimateView($id)
    {
        $estimate = Estimate::find($id);
        $services = $estimate->services;
        return view('backend.estimate.viewEstimate',compact('estimate','services'));
    }
}
