<?php

namespace App\Http\Controllers;

use App\Models\HighCourt;
use App\Models\LowerCourt;
use App\Models\User;
use App\Models\UserHigh;
use Illuminate\Http\Request;
use PDF;
use Session;
use PDOException;

class UserController extends Controller
{
    //user userAll
    public function userAll()
    {
        $data = array();
        $data['active_menu'] = 'user';
        $data['page_title'] = 'User List';
        $user = User::where('lower_court')->get();
        return view('backend.user.user_list', compact('data', 'user'));
    }
    // //userEdit
    // public function userDelete($id)
    // {
    //     User::find($id)->delete();
    //     return back()->with('message', 'User Deleted Successfully !!!');
    // }
    //userApprove
    public function userApprove()
    {
        $data = array();
        $data['active_menu'] = 'user';
        $data['page_title'] = 'User Approve List';
        $user = User::where('status', 'pending')->get();
        return view('backend.user.user_approve_list', compact('data', 'user'));
    }
    // //userApproveDetails
    // public function userApproveDetails($id)
    // {
    //     $user = User::find($id);
    //     $user->status = 'approved';
    //     $user->save();
    //     return back()->with('message','User Approved Successfully');
    // }
    public function investor_create()
    {
        $data = array();
        $data['active_menu'] = 'Investor';
        $data['page_title'] = 'Investor Create';
        if(request()->isMethod('post')){
                    try{
                       if(request()->hasFile('image')){
                           $extension = request()->file('image')->extension();
                           $photo_name= 'backend/img/user/'.uniqid().'.'.$extension;
                           request()->file('image')->move('backend/img/user', $photo_name);
                       }else{
                           $photo_name = null;
                       }
                       $serial_number = request('serial_number');
                       $name = request('name');
                       $bangla_name = request('bangla_name');
                       $fathers_name = request('fathers_name');
                       $mothers_name = request('mothers_name');
                       $spouse_name = request('spouse_name');
                       $birth_date = request('birth_date');
                       $marriage = request('marriage');
                       $present_address = request('present_address');
                       $permanent_address = request('permanent_address');
                       $phone = request('phone');
                       $email = request('email');
                       $facebook = request('facebook');
                       $Profession = request('profession');
                       $office_address = request('office_address');
                       $nid_passport = request('nid_passport');
                       $nationality = request('nationality');
                       $project_name = request('project_name');
                       $project_address = request('project_address');
                       $ownership_size = request('ownership_size');
                       $category_ownership = request('category_ownership');
                       $no_ownership = request('no_ownership');
                       $price_ownership = request('price_ownership');
                       $total_price = request('total_price');
                       $total_price_word = request('total_price_word');
                       $special_discount = request('special_discount');
                       $special_discount_word = request('special_discount_word');
                       $agreed_price = request('agreed_price');
                       $agreed_price_word = request('agreed_price_word');
                       $installment = request('installment');
                       $at_time = request('at_time');
                       $full_payment = request('full_payment');
                    //    cookie
                    $response = response('Set Cookie');
                    $cookieData = [
                        'name' => serialize([$serial_number, $name, $full_payment, $bangla_name, $photo_name, $fathers_name,
                            $mothers_name, $spouse_name, $birth_date, $marriage, $present_address, $permanent_address, $phone, $email,
                            $facebook, $Profession, $office_address, $nid_passport, $nationality, $project_name, $project_address,
                            $ownership_size, $category_ownership, $no_ownership, $price_ownership, $total_price, $total_price_word,
                            $special_discount, $special_discount_word, $agreed_price, $agreed_price_word, $installment, $at_time]),
                        'expires' => 60
                    ];

                    $response->withCookie($cookieData['name'], $cookieData['expires']);

                    $responseData = ['data' => $response];
                    Session::flash('responseData', $responseData);

                    return redirect()->route('investor.create2');
                    }catch(PDOException $e){
                       return redirect()->back()->with('error', 'Failed Please Try Again');
                    }
                   }
        return view('backend.investor.investorCreate',compact('data'));
    }
    public function investorCreate2(){
        $data = array();
        $data['active_menu'] = 'Investor';
        $data['page_title'] = 'Investor Create';
        if(request()->isMethod('post')){
            try{
               if(request()->hasFile('image')){
                   $extension = request()->file('image')->extension();
                   $photo_name= 'backend/img/user/'.uniqid().'.'.$extension;
                   request()->file('image')->move('backend/img/user', $photo_name);
               }else{
                   $photo_name = null;
               }
               $booking_money = request('booking_money');
               $booking_date = request('booking_date');
               $in_word = request('in_word');
               $payment_type = request('payment_type');
               $payment_type_date = request('payment_type_date');
               $bank_name = request('bank_name');
               $down_payment = request('down_payment');
               $down_payment_date = request('down_payment_date');
               $down_payment_inWord = request('down_payment_inWord');
               $payment_type2 = request('payment_type2');
               $payment_type_date2 = request('payment_type_date2');
               $no_of_installment = request('no_of_installment');
               $inst_per_month = request('inst_per_month');
               $start_from = request('start_from');
               $start_to = request('start_to');
               $others_instruction = request('others_instruction');
               $nominee_name = request('nominee_name');
               $nominee_cell_no = request('nominee_cell_no');
               $relation_to_nominee = request('relation_to_nominee');
               $nominee_image = $photo_name;
               $reference_name_a = request('reference_name_a');
               $reference_cell_a = request('reference_cell_a');
               $reference_name_b = request('reference_name_b');
               $reference_cell_b = request('reference_cell_b');

            $response = response('Set Cookie');
            $cookieData = [
                'name' => serialize([$booking_money, $booking_date, $in_word, $payment_type, $nominee_image, $payment_type_date,
                    $bank_name, $down_payment, $down_payment_date, $down_payment_inWord, $payment_type2, $payment_type_date2, $no_of_installment, $inst_per_month,
                    $start_from, $start_to, $others_instruction, $nominee_name, $nominee_cell_no, $relation_to_nominee, $reference_name_a,
                    $reference_cell_a, $reference_name_b, $reference_cell_b]),
                'expires' => 60
            ];

            $response->withCookie($cookieData['name'], $cookieData['expires']);

            $responseData = ['data' => $response];
            Session::flash('responseData', $responseData);

            return redirect()->route('investor.create3');
            }catch(PDOException $e){
               return redirect()->back()->with('error', 'Failed Please Try Again');
            }
           }
        return view('backend.investor.investorCreate2',compact('data'));
    }
    //investorCreate3
    public function investorCreate3()
    {
        $data = array();
        $data['active_menu'] = 'Investor';
        $data['page_title'] = 'Investor Create';
        return view('backend.investor.investorCreate3',compact('data'));
    }

}
