<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Maintenance;
use App\Models\MaintenancePay;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    //maintenance_get
    public function maintenance_get(Request $request)
    {
        $data = array();
        $data['active_menu'] = 'MaintenanceForm';
        $data['page_title'] = 'Maintenance Form';
        $customer = Customer::where('status', 'maintenance')->get();
        if ($request->isMethod('post')) {
            $maintenance = new Maintenance();
            $maintenance->customer_id = $request->customer_id;
            $maintenance->maintenance_amount = $request->maintenance_amount;
            $maintenance->maintenance_amount_inWord = $request->maintenance_amount_inWord;
            $maintenance->save();
            return back()->with('message', 'Maintenance Added Successfully');
        }
        return view('backend.maintenance.maintenance_add', compact('data', 'customer'));
    }
    //maintenance_list
    public function maintenance_list()
    {
        $data = array();
        $data['active_menu'] = 'MaintenanceList';
        $data['page_title'] = 'Maintenance  List';
        $maintenance = Maintenance::all();
        return view('backend.maintenance.maintenance_list', compact('data', 'maintenance'));
    }
    public function mantenaceDelete($id)
    {
        Maintenance::findOrFail($id)->delete();
        return back()->with('message', 'Maintenance Deleted Successfully');
    }
    // maintenancePay
    public function maintenancePay()
    {
        $data = array();
        $data['active_menu'] = 'MaintenancePaymentForm';
        $data['page_title'] = 'Maintenance  Payment';
        $maintenance = Maintenance::all();
        if (request()->isMethod('post')) {
            $this->validate(request(), [
                'maintenance_id' => 'required',
                'bank_name' => 'required',
                'branch_name' => 'required',
                'payment_type' => 'required',
                'amount' => 'required',
            ]);
            MaintenancePay::create([
                'maintenance_id' => request('maintenance_id'),
                'bank_name' => request('bank_name'),
                'branch_name' => request('branch_name'),
                'payment_type' => request('payment_type'),
                'amount' => request('amount'),
            ]);
            return back()->with('message', 'Maintenance Payment Successfully Done');
        }
        return view('backend.maintenance.maintenanaceForm', compact('data', 'maintenance'));
    }
    //maintenanceDue
    public function maintenanceDue()
    {
        $data = array();
        $data['active_menu'] = 'MaintenanceDue';
        $data['page_title'] = 'Maintenance Due';
        $currentMonth = now()->format('Y-m');
        $maintenanceIdsInCurrentMonth = MaintenancePay::whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$currentMonth])->pluck('maintenance_id')->toArray();
        $maintenance = Maintenance::whereNotIn('id', $maintenanceIdsInCurrentMonth)->get();
        // dd($maintenance);
        return view('backend.maintenance.maintenanceDue', compact('maintenance', 'data'));
    }
    //maintenancePaid
    public function maintenancePaid()
    {
        $data = array();
        $data['active_menu'] = 'maintenancePaid';
        $data['page_title'] = 'Maintenance Paid';
        $currentMonth = now()->format('Y-m');
        $maintenanceIdsInCurrentMonth = MaintenancePay::whereDate('created_at', 'LIKE', $currentMonth.'%')->pluck('maintenance_id');
        // dd($maintenanceIdsInCurrentMonth);
        $maintenance = Maintenance::whereIn('id',$maintenanceIdsInCurrentMonth)->get();
        return view('backend.maintenance.maintenancePaid', compact('maintenance', 'data'));
    }
    public function maintenanceReciept($id){
        $maintenancePay = Maintenance::with('maintenancePay')->find($id);
        // dd($maintenancePay);
        set_time_limit(1000);
        $pdf = Pdf::loadView('backend.maintenance.maintenanceReciept', compact('maintenancePay'));
        return $pdf->stream('maintenanceReciept.pdf');
    }
    //maintenance_invoice
    public function maintenance_invoice($id){
        $maintenance = Maintenance::find($id);
        set_time_limit(1000);
        $pdf = Pdf::loadView('backend.maintenance.maintenanceInvoice', compact('maintenance'));
        return $pdf->stream('maintenance_Invoice.pdf');
    }
}
