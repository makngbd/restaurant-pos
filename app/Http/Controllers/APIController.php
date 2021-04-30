<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Item;
use App\Sales;
use App\Cost;
use App\Order;
use App\StockHistory;
use App\KitchenHistory;
use App\DamageItem;
use App\CostHistory;
use App\Reservation;
use DB;

class APIController extends Controller {

    public function getLogin(Request $request) {
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            return response()->json(Auth::user());
        } else {
            return response()->json(false);
        }
    }

    public function getDashboard(Request $request) {
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            $start_date = date('Y-m') . '-01';
            $end_date = date('Y-m-d', strtotime('+6 hours'));
            $sales = Sales::select('date', DB::raw('SUM(amount) as amount'))
                    ->where('date', '>=', $start_date)->where('date', '<=', $end_date)
                    ->groupBy('date')
                    ->get();
            $costs = Cost::select('date', DB::raw('SUM(amount) as amount'))
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
            ($max_sales_amount > $max_cost_amount) ? $max_amount = $max_sales_amount : $max_amount = $max_cost_amount;
            $peak_value = ceil($max_amount / 100) * 100;
            return view('api.pages.api_dashboard')
                            ->with([
                                'menu_dashboard' => true,
                                'sales' => $sales,
                                'costs' => $costs,
                                'start_date' => $start_date,
                                'end_date' => $end_date,
                                'peak_value' => $peak_value
            ]);
        } else {
            return "Authentication Failed";
        }
    }

    public function getSearchSalesCost(Request $request) {
        if (Auth::check()) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $sales = Sales::select('date', DB::raw('SUM(amount) as amount'))
                    ->where('date', '>=', $start_date)->where('date', '<=', $end_date)
                    ->groupBy('date')
                    ->get();
            $costs = Cost::select('date', DB::raw('SUM(amount) as amount'))
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
            ($max_sales_amount > $max_cost_amount) ? $max_amount = $max_sales_amount : $max_amount = $max_cost_amount;
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
        } else {
            return "Authentication Failed";
        }
    }

    public function getSalesReport(Request $request) {
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            $start_date = date('Y-m') . '-01';
            $end_date = date('Y-m-d', strtotime('+6 hours'));
            $sales = Sales::select('product_id', 'product_name', 'product_code', 'product_price', DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(amount) as amount'))
                    ->where('date', '>=', $start_date)->where('date', '<=', $end_date)
                    ->groupBy('product_id', 'product_name', 'product_code', 'product_price')
                    ->get();
            return view('api.pages.api_sales')->with(['menu_sales' => true, 'sales' => $sales, 'start_date' => $start_date, 'end_date' => $end_date]);
        } else {
            return "Authentication Failed";
        }
    }

    public function getSearchSales(Request $request) {
        if (Auth::check()) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $sales = Sales::select('product_id', 'product_name', 'product_code', 'product_price', DB::raw('SUM(quantity) as quantity'), DB::raw('SUM(amount) as amount'))
                    ->where('date', '>=', $start_date)->where('date', '<=', $end_date)
                    ->groupBy('product_id', 'product_name', 'product_code', 'product_price')
                    ->get();
            return view('api.pages.api_sales')->with(['menu_sales' => true, 'sales' => $sales, 'start_date' => $start_date, 'end_date' => $end_date]);
        } else {
            return "Authentication Failed";
        }
    }

    public function getSummaryReport(Request $request) {
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            $start_date = date('Y-m') . '-01';
            $end_date = date('Y-m-d', strtotime('+6 hours'));
            $sales = Sales::select('date', DB::raw('SUM(amount) as amount'))
                    ->where('date', '>=', $start_date)->where('date', '<=', $end_date)
                    ->groupBy('date')
                    ->get();
            $costs = Cost::select('date', DB::raw('SUM(amount) as amount'))
                    ->where('date', '>=', $start_date)->where('date', '<=', $end_date)
                    ->groupBy('date')
                    ->get();
            return view('api.pages.api_summary_report')
                            ->with([
                                'menu_report' => true,
                                'menu_summary' => true,
                                'sales' => $sales,
                                'costs' => $costs,
                                'start_date' => $start_date,
                                'end_date' => $end_date
            ]);
        } else {
            return "Authentication Failed";
        }
    }

    public function getSearchSummaryReport(Request $request) {
        if (Auth::check()) {
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $sales = Sales::select('date', DB::raw('SUM(amount) as amount'))
                    ->where('date', '>=', $start_date)->where('date', '<=', $end_date)
                    ->groupBy('date')
                    ->get();
            $costs = Cost::select('date', DB::raw('SUM(amount) as amount'))
                    ->where('date', '>=', $start_date)->where('date', '<=', $end_date)
                    ->groupBy('date')
                    ->get();
            return view('api.pages.api_summary_report')
                            ->with([
                                'menu_report' => true,
                                'menu_summary' => true,
                                'sales' => $sales,
                                'costs' => $costs,
                                'start_date' => $start_date,
                                'end_date' => $end_date
            ]);
        }
    }
public function getDiscountReport() {
        $start_date = date('Y-m') . '-01';
        $end_date = date('Y-m-d', strtotime('+6 hours'));
        $reference_name = '';
        $orders = Order::whereNotNull('discount_reference')
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->get();
        $references = Order::select('discount_reference')
                ->whereNotNull('discount_reference')
                ->groupBy('discount_reference')
                ->get();
        return view('api.pages.api_discount_report')
                        ->with([
                            'menu_report' => true,
                            'menu_discount' => true,
                            'orders' => $orders,
                            'references' => $references,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'reference_name' => $reference_name,
        ]);
    }

    public function searchDiscountReport(Request $request) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $reference_name = $request->input('discount_reference');
        $orders = Order::whereNotNull('discount_reference')
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->when($reference_name, function($query) use ($reference_name) {
                    return $query->where('discount_reference', $reference_name);
                })
                ->get();
        $references = Order::select('discount_reference')
                        ->whereNotNull('discount_reference')
                        ->groupBy('discount_reference')->get();
        return view('api.pages.api_discount_report')
                        ->with([
                            'menu_report' => true,
                            'menu_discount' => true,
                            'orders' => $orders,
                            'references' => $references,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'reference_name' => $reference_name,
        ]);
    }

    public function getWarehouseReport() {
        $start_date = date('Y-m') . '-01';
        $end_date = date('Y-m-d', strtotime('+6 hours'));
        $item_id = 0;
        $status = '';
        $stocks = StockHistory::where('deletation_status', false)
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->get();
        $items = Item::where('deletation_status', false)->get();
        return view('api.pages.api_warehouse_report')
                        ->with([
                            'menu_report' => true,
                            'menu_warehouse_report' => true,
                            'stocks' => $stocks,
                            'items' => $items,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'item_id' => $item_id,
                            'status' => $status,
        ]);
    }

    public function searchWarehouseReport(Request $request) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $item_id = $request->input('item_id');
        $status = $request->input('status');

        $stocks = StockHistory::where('deletation_status', false)
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->when($item_id, function($query) use ($item_id) {
                    return $query->where('item_id', $item_id);
                })
                ->when($status, function($query) use ($status) {
                    return $query->where('status', $status);
                })
                ->get();
        $items = Item::where('deletation_status', false)->get();
        return view('api.pages.api_warehouse_report')
                        ->with([
                            'menu_report' => true,
                            'menu_warehouse_report' => true,
                            'stocks' => $stocks,
                            'items' => $items,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'item_id' => $item_id,
                            'status' => $status,
        ]);
    }

    public function getKitchenReport() {
        $start_date = date('Y-m') . '-01';
        $end_date = date('Y-m-d', strtotime('+6 hours'));
        $item_id = 0;
        $status = '';
        $k_stocks = KitchenHistory::where('deletation_status', false)
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->get();
        $items = Item::where('deletation_status', false)->get();
        return view('api.pages.api_kitchen_report')
                        ->with([
                            'menu_report' => true,
                            'menu_kitchen_report' => true,
                            'stocks' => $k_stocks,
                            'items' => $items,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'item_id' => $item_id,
                            'status' => $status,
        ]);
    }

    public function searchKitchenReport(Request $request) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $item_id = $request->input('item_id');
        $status = $request->input('status');
        $k_stocks = KitchenHistory::where('deletation_status', false)
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->when($item_id, function($query) use ($item_id) {
                    return $query->where('item_id', $item_id);
                })
                ->when($status, function($query) use ($status) {
                    return $query->where('status', $status);
                })
                ->get();
        $items = Item::where('deletation_status', false)->get();
        return view('api.pages.api_kitchen_report')
                        ->with([
                            'menu_report' => true,
                            'menu_kitchen_report' => true,
                            'stocks' => $k_stocks,
                            'items' => $items,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'item_id' => $item_id,
                            'status' => $status,
        ]);
    }

    public function getDamageReport() {
        $start_date = date('Y-m') . '-01';
        $end_date = date('Y-m-d', strtotime('+6 hours'));
        $item_id = 0;
        $damage_from = '';
        $damage_items = DamageItem::where('deletation_status', false)
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->get();
        $items = Item::where('deletation_status', false)->get();
        return view('api.pages.api_damage_report')
                        ->with([
                            'menu_report' => true,
                            'menu_damage_report' => true,
                            'damage_items' => $damage_items,
                            'items' => $items,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'item_id' => $item_id,
                            'damage_from' => $damage_from,
        ]);
    }

    public function searchDamageReport(Request $request) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $item_id = $request->input('item_id');
        $damage_from = $request->input('damage_from');
        $damage_items = DamageItem::where('deletation_status', false)
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->when($item_id, function($query) use ($item_id) {
                    return $query->where('item_id', $item_id);
                })
                ->when($damage_from, function($query) use ($damage_from) {
                    return $query->where('damage_from', $damage_from);
                })
                ->get();
        $items = Item::where('deletation_status', false)->get();
        return view('api.pages.api_damage_report')
                        ->with([
                            'menu_report' => true,
                            'menu_damage_report' => true,
                            'damage_items' => $damage_items,
                            'items' => $items,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'item_id' => $item_id,
                            'damage_from' => $damage_from,
        ]);
    }
    
    public function getCostReport() {
        $start_date = date('Y-m') . '-01';
        $end_date = date('Y-m-d', strtotime('+6 hours'));
        $cost_type = '';
        $costs = CostHistory::where('deletation_status', false)
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->get();
        return view('api.pages.api_cost_report')
                        ->with([
                            'menu_report' => true,
                            'menu_cost_report' => true,
                            'costs' => $costs,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'cost_type' => $cost_type,
        ]);
    }

    public function searchCostReport(Request $request) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $cost_type = $request->input('cost_type');
        $costs = CostHistory::where('deletation_status', false)
                ->where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->when($cost_type, function($query) use ($cost_type) {
                    return $query->where('cost_type', $cost_type);
                })
                ->get();
        return view('api.pages.api_cost_report')
                        ->with([
                            'menu_report' => true,
                            'menu_cost_report' => true,
                            'costs' => $costs,
                            'start_date' => $start_date,
                            'end_date' => $end_date,
                            'cost_type' => $cost_type,
        ]);
    }
    public function apiReservation(){
        $reservations = Reservation::orderBy('id', 'desc')->get();
        $view = view('api/pages/api_reservation');
        $view->with('reservations', $reservations);
        $view->with('menu_reservation', true);
        return $view;
    }
    public function reservation(){
        $reservations = Reservation::orderBy('id', 'desc')->get();
        $view = view('admin/pages/reservation');
        $view->with('reservations', $reservations);
        $view->with('menu_reservation', true);
        return $view;
    }
    public function saveReservation(Request $request) {
        $input = $request->all();
        if (Reservation::create($input)) {
            $message = "<h1 style=\"color:#5EA158;\">Reservation submitted successfully!!!</h1>";
        } else {
            $message = "<h1 style=\"color:#EA594C;\">Reservation submission failed!</h1>";
        }
        return $message;
    }

}
