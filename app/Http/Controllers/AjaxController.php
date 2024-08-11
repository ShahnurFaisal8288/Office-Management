<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Investor;
use App\Models\InvestorPay;
use App\Models\Invoice;
use App\Models\Maintenance;
use App\Models\ProjectModule;
use App\Models\Service;
use App\Models\Task;
use App\Models\TaskDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class AjaxController extends Controller
{
    //getName
    public function getName()
    {
        $id = request()->serial_No;

        // $investorPay=InvestorPay::where('investor_id',$id)->latest()->first();
        // $paidMonth=$investorPay->end_month ?? 'null';
        $invoice = Invoice::with('customer','services')->where('customer_id', $id)->first();
        $invoicePay = InvestorPay::where('customer_id',$invoice->customer_id)->sum('total');
        $invPaid = $invoicePay + $invoice->advance;
        $invDue = $invoice->dueAmount - $invoicePay;
        return response()->json([$invoice,$invPaid,$invDue]);

    }
    //getPrice
    public function getPrice()
    {
        $id = request()->service_id;
        $service=Service::where('id',$id)->first();
        return response()->json([$service]);
    }
    //getMaintenanceAmount
    public function getMaintenanceAmount(){
        $customer_id = request()->serial_No;
        $maintenance = Maintenance::with('customer')->where('id', $customer_id)->first();
        return response()->json($maintenance);
    }
    //getPermission
    public function getPermission(Request $request)
    {
        $module_id = $request->post('module_id');
        $subModule = DB::table('sub_modules')->where('module_id', $module_id)->get();
        $html = '<option value="">Select A Sub Module</option>';
        foreach ($subModule as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->subModule_name . '</option>';
        }
        return response()->json($html);
    }
    //getDue
    public function getDue(Request $request) {
        $customer_id = $request->input('customer_id');
    
        $invoicePay = InvestorPay::where('customer_id', $customer_id)->sum('total');
        $advance = Invoice::where('customer_id', $customer_id)->sum('advance');
        $totalPaid = $invoicePay + $advance;
        // $totalAmount = Invoice::with('services')->where('customer_id', $customer_id)->sum('amount');
    
        // $dueAmount = $totalAmount - $totalPaid;
        $totalAmount = DB::table('invoices')
                    // ->join('invoices', 'invoices.id', '=', 'invoice_service.invoice_id')
                    ->where('invoices.customer_id', $customer_id)
                    ->sum('total_amount');

    // Calculate the due amount
    $dueAmount = $totalAmount - $totalPaid;


// Calculate the due amount
        return response()->json([
            'paid' => $totalPaid,
            'due' => $dueAmount
        ]);
    }
    //getAmount
   

    public function getAmount(Request $request) {
        $employee_id = $request->input('employee_id');
        $employee = Employee::where('id', $employee_id)->select('pay_agreement', 'authId')->first();
        $currentMonth = now()->subMonth()->month;
        $tasks = TaskDetail::where('employee_id', $employee->authId)->whereMonth('created_at',$currentMonth)->where('title')->get();
    
        if ($employee && $tasks->isNotEmpty()) {
            return response()->json([
                'amount' => $employee,
                'deliverables' => $tasks->pluck('title')
            ], 200);
            
        } elseif ($employee) {
            return response()->json([
                'amount' => $employee->pay_agreement,
                'deliverables' => []
            ], 200);
        } elseif ($tasks->isNotEmpty()) {
            return response()->json([
                'amount' => '',
                'deliverables' => $tasks->pluck('title')
            ], 200);
        }
        
        return response()->json(['amount' => 0], 404);
    }
    //getModule
    public function getModule(Request $request){
        $projectId = $request->input('project_id');
        $modules = ProjectModule::where('project_id', $projectId)->get();
        $html = '<option value="">Select</option>';
        foreach ($modules as $value) {
            $html .= '<option value="' . $value->id . '">' . $value->module_name . '</option>';
        }
        return response()->json($html);
    }
    //getFeatures
    public function getFeatures(Request $request){
        $module_id = $request->input('module_id');
        $modules = ProjectModule::where('id', $module_id)->get();
        $html = '<option value="">Select</option>';
        foreach ($modules as $value) {
            // Decode the JSON string into an array
            $features = json_decode($value->features, true);
            
            // Check if the features are properly decoded and are an array
            if (is_array($features)) {
                foreach ($features as $feature) {
                    $html .= '<option value="' . $feature . '">' . $feature . '</option>';
                }
            }
        }
        return response()->json($html);
    }
}
