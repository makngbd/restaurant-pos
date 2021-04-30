<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Sales;
use App\CostHistory;

class UserController extends Controller {

    public function getIndex() {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('admin.pages.admin_login');
    }

    public function getDeshboard() {
        $start_date = date('Y-m') . '-01';
        $end_date = date('Y-m-d', strtotime('+6 hours'));
        $sales = Sales::select('date', DB::raw('SUM(amount) as amount'))
                ->where('date', '>=', $start_date)->where('date', '<=', $end_date)
                ->groupBy('date')
                ->get();
        $costs = CostHistory::select('date', DB::raw('SUM(amount) as amount'))
                ->where('date', '>=', $start_date)->where('date', '<=', $end_date)
                ->groupBy('date')
                ->get();
        $max_sales_amount = 0;
        foreach ($sales as $key => $sale) {
            if ($sale->amount > $max_sales_amount) {
                $max_sales_amount = $sale->amount;
            }
        }
        $max_cost_amount = 0;
        foreach ($costs as $key => $cost) {
            if ($cost->amount > $max_cost_amount) {
                $max_cost_amount = $cost->amount;
            }
        }
        ($max_sales_amount> $max_cost_amount)? $max_amount = $max_sales_amount : $max_amount = $max_cost_amount;
        $peak_value = ceil($max_amount / 100) * 100;
        return view('admin.pages.admin_dashboard')
                        ->with([
                            'menu_dashboard' => true,
                            'sales' => $sales,
                            'costs' => $costs,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'peak_value' => $peak_value
        ]);
    }
    public function getSearchSalesCost(Request $request){
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $sales = Sales::select('date', DB::raw('SUM(amount) as amount'))
                ->where('date', '>=', $start_date)->where('date', '<=', $end_date)
                ->groupBy('date')
                ->get();
        $costs = CostHistory::select('date', DB::raw('SUM(amount) as amount'))
                ->where('date', '>=', $start_date)->where('date', '<=', $end_date)
                ->groupBy('date')
                ->get();
        $max_sales_amount = 0;
        foreach ($sales as $key => $sale) {
            if ($sale->amount > $max_sales_amount) {
                $max_sales_amount = $sale->amount;
            }
        }
        $max_cost_amount = 0;
        foreach ($costs as $key => $cost) {
            if ($cost->amount > $max_cost_amount) {
                $max_cost_amount = $cost->amount;
            }
        }
        ($max_sales_amount> $max_cost_amount)? $max_amount = $max_sales_amount : $max_amount = $max_cost_amount;
        $peak_value = ceil($max_amount / 100) * 100;
        return view('admin.pages.admin_dashboard')
                        ->with([
                            'menu_dashboard' => true,
                            'sales' => $sales,
                            'costs' => $costs,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'peak_value' => $peak_value
        ]);
    }

    public function getLogin() {
        return view('admin.pages.admin_login');
    }

    public function postLogin(Request $request) {
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back();
        }
    }

    public function getLogout() {
        Auth::logout();
        return redirect()->route('login');
    }

    public function myProfile() {
        return view('admin.pages.my_profile')->with(['menu_profile' => true]);
    }

    public function editProfile() {
        $user = Auth::user();
        return view('admin.pages.edit_profile')->with(['user' => $user, 'menu_profile' => true]);
    }

    public function updateProfile(Request $request) {
        $this->validate($request, [
            'email' => 'email|required',
            'username' => 'required|min:3'
        ]);
        $id = Auth::id();
        DB::table('users')
                ->where('id', $id)
                ->update([
                    'fname' => $request->input('fname'),
                    'lname' => $request->input('lname'),
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
        ]);
        return redirect()->route('my_profile');
    }

    public function changeMyPassword() {
        $user = Auth::user();
        return view('admin.pages.change_my_password')->with(['user' => $user, 'menu_profile' => true]);
    }

    public function updateMyPassword(Request $request) {
        $this->validate($request, [
            'password' => 'required|min:4|confirmed',
        ]);
        $id = Auth::id();
        DB::table('users')
                ->where('id', $id)
                ->update([
                    'password' => bcrypt($request->input('password')),
        ]);
        return redirect()->route('my_profile');
    }

}
