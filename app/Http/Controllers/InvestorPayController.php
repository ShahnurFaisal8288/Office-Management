<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\InvestorPay;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvestorPayController extends Controller
{
    //InvestorPay
    public function investor_pay()
    {
        $data = array();
        $data['active_menu'] = 'InvestorPay';
        $data['page_title'] = 'Investor Pay';
        $invoice = Invoice::all();
        // dd($invoice);

        if (request()->isMethod('post')) {
            try {
                // dd(request()->all());
                InvestorPay::create([
                    'customer_id' => request('invoice_no'),
                    'bank_name' => request('bank_name'),
                    'invoice_id' => request('invoice_id'),
                    'payment_type' => request('payment_type'),
                    'branch_name' => request('branch_name'),
                    'amountInWord' => request('amountInWord'),
                    'total' => request('total'),
                ]);

             return back()->with('message','Investor Payment Successfully!!!');
            } catch (\Throwable $th) {
                return  $th;
            }
        }
        return view('backend.investor.investorPay',compact('data','invoice'));
    }
    //paymentList
    public function paymentList(){
        $data = array();
        $data['active_menu'] = 'InvestorList';
        $data['page_title'] = 'Payment List';
        $investorPay = InvestorPay::with('customers')->get();
        return view('backend.investor.paymentList',compact('data','investorPay'));
    }
    //investorPayDelete
    public function investorPayDelete($id){
      InvestorPay::find($id)->delete();
      return back()->with('message','Investor Payment Deleted Successfully!!!');
    }
    ////investorPay_view
   public function investorPay_View($id)
   {
    $investorPay = InvestorPay::find($id);
    return view('backend.investor.investorPay_view',compact('investorPay'));
   }
}
