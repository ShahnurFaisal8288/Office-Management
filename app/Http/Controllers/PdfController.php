<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Estimate;
use App\Models\Investor;
use App\Models\InvestorPay;
use App\Models\Invoice;
use App\Models\PurchaseOrder;
use PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    //investorPdf
    public function investorPdf($id)
    {
        $investor = Investor::find($id);
        $investorWithEmployees = $investor->with('employees')->first();
        $employees = $investorWithEmployees->employees;
        // return view('backend.pdf.investorPdf',compact('investor','investorWithEmployees','employees'));


        $pdf = PDF::loadView('backend.pdf.investorPdf', compact('investor', 'investorWithEmployees', 'employees'));
        return $pdf->download('Investor_details.pdf');
    }
    //investorPay_print
    public function investorPay_print($id)
    {
        $investorPay = InvestorPay::find($id);
        // set_time_limit(1000);
        $pdf = PDF::loadView('backend.pdf.investorPayPdf', compact('investorPay'));
        return $pdf->download('money_receipt.pdf');
        // return view('backend.pdf.investorPayPdf', compact('investorPay'));
    }
    //investorPay_View
    public function investorPay_View($id)
    {
        $investorPay = InvestorPay::find($id);


        return view('backend.invoice.investorPayView', compact('investorPay'));
    }
    //invoicePdf
    public function invoicePdf($id)
    {
        $invoice = Invoice::find($id);
        $services = $invoice->services;
        // dd($services);
        // set_time_limit(1000);
        $pdf = PDF::loadView('backend.invoice.printInvoice', compact('invoice', 'services'));
        return $pdf->stream('invoice.pdf');
        // return view('backend.invoice.printInvoice', compact('invoice', 'services'));
    }
    //employeePrint
    public function employeePrint($id)
    {
        $employee = Employee::find($id);
        set_time_limit(1000);
        $pdf = PDF::loadView('backend.employee.employeePrint',compact('employee'));
        return $pdf->stream('employee.pdf');
        // return view('backend.employee.employeePrint', compact('employee'));
    }
    //bookingInvoice
    public function bookingInvoice($id){
        $invoice = Invoice::find($id);
        // set_time_limit(1000);
        $pdf = PDF::loadView('backend.pdf.bookingInvoicePdf',compact('invoice'));
        return $pdf->stream('advanceMoney.pdf');
        // return view('backend.pdf.bookingInvoicePdf',compact('invoice'));
    }
    //estimatePdf
    public function estimatePdf($id)
    {
        $estimate = Estimate::find($id);
        $services = $estimate->services;
        set_time_limit('1000');
        $pdf = Pdf::loadView('backend.estimate.printEstimate',compact('estimate','services'));
        return $pdf->stream('estimate.pdf');
    }
    //poPdf
    public function purchaseOrderPdf($id)
    {
        $purchaseOrder = PurchaseOrder::find($id);
        $services = $purchaseOrder->purchaseOrderQuantities;
        set_time_limit('1000');
        $pdf = Pdf::loadView('backend.purchaseOrder.printPo',compact('purchaseOrder','services'));
        return $pdf->stream('po.pdf');
    }
}
