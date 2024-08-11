<?php

namespace App\Http\Controllers;

use App\Models\AdminAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\CheckOldPassword;

class AdminAuthController extends Controller
{
    ///register
    public function register()
    {
        if(request()->isMethod('post'))
        {
            // $this->validate(request(), [
            //     'name' => 'required',
            //     'email' => 'required|unique:users,email',
            //     'password' => 'required|min:7',
            //     'confirm_password' => 'required|same:password|min:7',
            // ]);

            AdminAuth::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => bcrypt(request('password')),

            ]);
            return to_route('login');
        }
        return view('backend.Admin.registration');
    }
    ///login
    public function login()
    {

        if(request()->isMethod('post')){
            $this->validate(request(), [
                'email' => 'required|email',
                'password' => 'required|min:7'
            ]);

            if (Auth::guard('admin')->attempt([
                'email' => request('email'),
                'password' => request('password'),
            ])) {
                return to_route('admin.dashboard');
            } else {
                return 'credential not matched';
            }
        }
        return view('backend.Admin.login');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return to_route('login');
    }
    //myProfile
    public function myProfile(Request $request,$id){
        $data = array();
        $data['active_menu'] = 'batch_panel';
        $data['page_title'] = 'User Profile';
        $auth = AdminAuth::find($id);
        if(request()->isMethod('post')){
            $auth->name = $request->name;
            $auth->email = $request->email;
            if ($request->file('image')) {
                $auth->image = $this->makeImage($request);
            }
            $auth->save();
            return back()->with('success', 'Admin Profile Updated Successfully');
        }
        return view('backend.Admin.profile',compact('data','auth'));
    }
    //makeImage
    public function makeImage($request){
        $image = $request->file('image');
        $imageName = rand().'.'.$image->getClientOriginalExtension();
        $directory = public_path('backend/assets/Admin-image/');
        $path = 'backend/assets/Admin-image/';
        $imageUrl = $path . $imageName;
        $image->move($directory, $imageName);
        return $imageUrl;
    }
    //changePassword
    public function changePassword(Request $request,$id){
        $data = array();
        $data['active_menu'] = 'batch_panel';
        $data['page_title'] = 'User Password Change';
        $auth = AdminAuth::find($id);
        if(request()->isMethod('post')){
            $request->validate([
                'oldPassword' => [
                    'required',
                    // new App\Http\Controllers\CheckOldPassword,
                ],
                'newPassword'=>'required',
                'confirmPassword'=>'required|same:newPassword',
            ]);
            $authPassword = auth('admin')->user()->password;
            if (Hash::check($request->oldPassword,$authPassword)) {
                $user = AdminAuth::find(auth('admin')->user()->id);
                $user->password = bcrypt($request->newPassword);
                $user->save();
            return back()->with('success', 'Admin Change Password Successfully');
        }
    }
        return view('backend.Admin.changePassword',compact('data','auth'));
    }
}
