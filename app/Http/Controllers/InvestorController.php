<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Investor;
use Illuminate\Http\Request;
use PDOException;
use PDF;
use Session;
use Illuminate\Support\Facades\File;

class InvestorController extends Controller
{
    public function investor_create()
    {
        $data = array();
        $data['active_menu'] = 'Customer';
        $data['page_title'] = 'Customer Create';
        $customer = Investor::where('status', 'customer')->get();
        if (request()->isMethod('post')) {

            try {
                // if (request()->hasFile('user_image')) {
                //     $extension = request()->file('user_image')->extension();
                //     $photo_name = 'backend/img/user/' . uniqid() . '.' . $extension;
                //     request()->file('user_image')->move('backend/img/user', $photo_name);
                // } else {
                //     $photo_name = null;
                // }
                // if (request()->hasFile('nominee_image')) {
                //     $extension = request()->file('nominee_image')->extension();
                //     $image_name = 'backend/img/nominee/' . uniqid() . '.' . $extension;
                //     request()->file('nominee_image')->move('backend/img/nominee', $image_name);
                // } else {
                //     $image_name = null;
                // }
                // $status = 'accept';

                Investor::create([
                    'serial_number' => request('serial_number'),
                    'project_name' => request('project_name'),
                    'project_details' => request('project_details'),
                    'project_owner_name' => request('project_owner_name'),
                    'project_owner_cell_no' => request('project_owner_cell_no'),
                    'project_owner_email' => request('project_owner_email'),
                    'project_value' => request('project_value'),
                    'lead' => request('lead'),
                    'end_date' => request('end_date'),
                    'start_date' => request('start_date'),
                ]);
                // $investorListPdf->employees()->attach(request('employee_id'));
                // $investorWithEmployees = $investorListPdf->with('employees')->first();
                // $employees = $investorWithEmployees->employees;
                // if (request('investorPdfGenerate') == '1') {
                //     $pdf = PDF::loadView('backend.pdf.investorListPdf',compact('investorListPdf','employees','investorWithEmployees'));
                //     return $pdf->download('Investor_details.pdf');
                // }

                return redirect()->route('investor_create')->with('message', 'Investor Created Successfully!!!');
            } catch (PDOException $e) {
                return $e;
            }
        } else {
        }
        return view('backend.investor.investorCreate', compact('data','customer'));
    }
    //investorApprove
    public function investorApprove()
    {
        $data = array();
        $data['active_menu'] = 'investorApprove';
        $data['page_title'] = 'Investor Approve List';
        $investor = Investor::where('status', 'lead')->get();
        return view('backend.investor.investorApproveList', compact('data', 'investor'));
    }
    //approve
    public function customer($id)
    {
        $investor = Investor::find($id);
        $investor->status = 'customer';
        $investor->save();
        return back()->with('message', 'Lead Turn Into Customer Successfully!!!');
    }
    //investorList
    public function investorList()
    {
        $data = array();
        $data['active_menu'] = 'investorList';
        $data['page_title'] = 'Investor List';
        $investor = Investor::where('status', 'customer')->get();

        return view('backend.investor.investorList', compact('data', 'investor'));
    }
    //investor_delete
    public function investor_delete($id)
    {
        $investor = Investor::find($id);
        $investors = $investor->user_image;
        $investorsNominee = $investor->nominee_image;
        if (File::exists($investors)) {
            File::delete($investors);
        }
        if (File::exists($investorsNominee)) {
            File::delete($investorsNominee);
        }
        $investor->delete();
        return back()->with('message', 'Investor Deleted Successfully!!!');
    }
}
