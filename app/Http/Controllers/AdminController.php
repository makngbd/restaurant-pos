<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Setting;
use App\Company;
use Illuminate\Http\Request;
use DB;

class AdminController extends UserController {

    public function addUser() {
        return view('admin.pages.add_user')->with(['menu_user' => true]);
    }

    public function saveUser(Request $request) {
        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4|confirmed',
            'username' => 'required|min:3|unique:users'
        ]);
        $user = new User([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'phone' => $request->input('phone'),
            'role' => $request->input('role'),
            'created_by' => Auth::id(),
        ]);
        $user->save();
        return view('admin.pages.add_user')->with(['success' => 'New user added']);
    }

    public function manageUser() {
        $users = User::where('deletation_status', false)->orderBy('id','desc')->get();
        return view('admin.pages.manage_user')
                        ->with([
                            'menu_user' => true,
                            'users' => $users
        ]);
    }

    public function editUser($id) {
        $user = User::find($id);
        return view('admin.pages.edit_user')->with(['user' => $user, 'menu_user' => true]);
    }

    public function updateUser(Request $request, $id) {
        $this->validate($request, [
            'email' => 'email|required|unique:users,id,{$id}',
            'username' => 'required|min:3|unique:users,id,{$id}'
        ]);
        DB::table('users')
                ->where('id', $id)
                ->update([
                    'fname' => $request->input('fname'),
                    'lname' => $request->input('lname'),
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'role' => $request->input('role'),
        ]);
        return redirect()->route('manage_user');
    }

    public function changePassword($id) {
        $user = User::find($id);
        return view('admin.pages.change_password')->with(['user' => $user, 'menu_user' => true]);
    }

    public function updatePassword(Request $request, $id) {
        $this->validate($request, [
            'password' => 'required|min:4|confirmed',
        ]);
        DB::table('users')
                ->where('id', $id)
                ->update([
                    'password' => bcrypt($request->input('password')),
        ]);
        return redirect()->route('manage_user');
    }

    public function deleteUser($id) {
        User::where('id', $id)->update(['deletation_status' => true]);
        return redirect()->route('manage_user');
    }

    public function getSettings() {
        return view('admin.pages.settings')->with(['menu_setting' => true]);
    }

    public function getChangeSettings() {
        $settings = Setting::all()->last();
        return view('admin.pages.change_settings')
                        ->with([
                            'menu_setting' => true,
                            'settings' => $settings
        ]);
    }

    public function getUpdateSettings(Request $request) {
        $setting = new Setting([
            'discount_type' => $request->input('discount_type'),
            'discount' => $request->input('discount'),
            'discount_deadline' => $request->input('discount_deadline'),
            'vat' => $request->input('vat'),
            'service_charge' => $request->input('service_charge'),
            'user_id' => Auth::id(),
        ]);
        $setting->save();
        return redirect()->route('settings');
    }

    public function manageCompanyProfile() {
        $company_profile = Company::all()->last();
        return view('admin.pages.manage_company_profile')
                        ->with([
                            'menu_company' => true,
                            'company_profile' => $company_profile
        ]);
    }

    public function editCompanyProfile() {
        $company_profile = Company::all()->last();
        return view('admin.pages.edit_company_profile')
                        ->with([
                            'menu_company' => true,
                            'company_profile' => $company_profile
        ]);
    }

    public function updateCompanyProfile(Request $request) {
        $this->validate($request, [
            'company_name' => 'required'
        ]);
        $company_profile = new Company([
            'company_name' => $request->input('company_name'),
            'company_address' => $request->input('company_address'),
            'company_email' => $request->input('company_email'),
            'company_phone' => $request->input('company_phone'),
            'company_vat_reg_no' => $request->input('company_vat_reg_no'),
            'user_id' => Auth::id(),
        ]);
        $company_profile->save();
        return redirect()->route('manage_company_profile');
    }

    

}
