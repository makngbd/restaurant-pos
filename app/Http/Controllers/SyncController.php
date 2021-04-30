<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Order;
use App\Sales;
use App\SalaryCost;
use App\EquipmentCost;
use App\CostHistory;
use App\Item;
use App\Stock;
use App\StockHistory;
use App\Kitchen;
use App\KitchenHistory;
use App\DamageItem;
use Auth;
use Session;

session_start();

class SyncController extends Controller {

    public function getSyncPage() {
        return view('admin.pages.sync_page')
                        ->with([
                            'menu_sync' => true
        ]);
    }

    public function syncJsonData() {

        $url = 'http://admin.royalrestaurantbd.com';

        $result = $this->localSendData();
        if ($result) {
            Category::where('version_number', 0)->update(['version_number' => 1]);
            Product::where('version_number', 0)->update(['version_number' => 1]);
            Order::where('version_number', 0)->update(['version_number' => 1]);
            Sales::where('version_number', 0)->update(['version_number' => 1]);
            SalaryCost::where('version_number', 0)->update(['version_number' => 1]);
            EquipmentCost::where('version_number', 0)->update(['version_number' => 1]);
            CostHistory::where('version_number', 0)->update(['version_number' => 1]);
            Item::where('version_number', 0)->update(['version_number' => 1]);
            Stock::where('version_number', 0)->update(['version_number' => 1]);
            StockHistory::where('version_number', 0)->update(['version_number' => 1]);
            Kitchen::where('version_number', 0)->update(['version_number' => 1]);
            KitchenHistory::where('version_number', 0)->update(['version_number' => 1]);
            DamageItem::where('version_number', 0)->update(['version_number' => 1]);
            
            
            Session::put('success_upload', "Uploading synchronization successfully!!!");
        } else {
            Session::put('error_upload', "Uploading synchronization failed!!!");
        }
//        $result = $this->localStoreData();
//        if ($result) {
//            Session::put('success_download', "Downloading synchronization successfully!!!");
//        } else {
//            Session::put('error_download', "Downloading synchronization failed!!!");
//        }

        return redirect()->route('sync_data');
    }

    private function localSendData() {
        $category_data = Category::where('version_number', 0)->get()->toJson();
        $product_data = Product::where('version_number', 0)->get()->toJson();
        $order_data = Order::where('version_number', 0)->get()->toJson();
        $sales_data = Sales::where('version_number', 0)->get()->toJson();
        $salary_cost_data = SalaryCost::where('version_number', 0)->get()->toJson();
        $equipment_cost_data = EquipmentCost::where('version_number', 0)->get()->toJson();
        $cost_history_data = CostHistory::where('version_number', 0)->get()->toJson();
        $items_data = Item::where('version_number', 0)->get()->toJson();
        $stock_data = Stock::where('version_number', 0)->get()->toJson();
        $stock_history_data = StockHistory::where('version_number', 0)->get()->toJson();
        $kitchen_data = Kitchen::where('version_number', 0)->get()->toJson();
        $kitchen_history_data = KitchenHistory::where('version_number', 0)->get()->toJson();
        $damage_items_data = DamageItem::where('version_number', 0)->get()->toJson();

        $url = 'http://admin.royalrestaurantbd.com/live-store-data';
        $fields = array(
            'data_category' => urlencode($category_data),
            'data_product' => urlencode($product_data),
            'data_order' => urlencode($order_data),
            'data_sales' => urlencode($sales_data),
            'data_salary_cost' => urlencode($salary_cost_data),
            'data_equipment_cost' => urlencode($equipment_cost_data),
            'data_cost_history' => urlencode($cost_history_data),
            'data_items' => urlencode($items_data),
            'data_stock' => urlencode($stock_data),
            'data_stock_history' => urlencode($stock_history_data),
            'data_kitchen' => urlencode($kitchen_data),
            'data_kitchen_history' => urlencode($kitchen_history_data),
            'data_damage_items' => urlencode($damage_items_data),
        );
        $fields_string = '';
        //url-ify the data for the POST
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);
        return $result;
    }

    /*
     * The function localStoreData get data from remote database and store 
     * to local database
     */

//    private function localStoreData() {
//        $url = 'http://admin.royalrestaurantbd.com/live-send-data';
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_URL, $url);
//        $result = curl_exec($ch);
//        curl_close($ch);
//
//        $obj = json_decode($result);
//        if ($result) {
//            $category_data = urldecode($obj->data_category);
//            $product_data = urldecode($obj->data_product);
//            $order_data = urldecode($obj->data_order);
//            $sales_data = urldecode($obj->data_sales);
//            $salary_cost_data = urldecode($obj->data_salary_cost);
//            $equipment_cost_data = urldecode($obj->data_equipment_cost);
//            $cost_history_data = urldecode($obj->data_cost_history);
//            $items_data = urldecode($obj->data_items);
//            $stock_data = urldecode($obj->data_stock);
//            $stock_history_data = urldecode($obj->data_stock_history);
//            $kitchen_data = urldecode($obj->data_kitchen);
//            $kitchen_history_data = urldecode($obj->data_kitchen_history);
//            $damage_items_data = urldecode($obj->data_damage_items);
//
//            $category = json_decode($category_data);
//            $products = json_decode($product_data);
//            $order = json_decode($order_data);
//            $sales = json_decode($sales_data);
//            $salary_cost = json_decode($salary_cost_data);
//            $equipment_cost = json_decode($equipment_cost_data);
//            $cost_history = json_decode($cost_history_data);
//            $items = json_decode($items_data);
//            $stock = json_decode($stock_data);
//            $stock_history = json_decode($stock_history_data);
//            $kitchen = json_decode($kitchen_data);
//            $kitchen_history = json_decode($kitchen_history_data);
//            $damage_items = json_decode($damage_items_data);
//
//            $this->save_category($category);
//            $this->save_products($products);
//            $this->save_order($order);
//            $this->save_sales($sales);
//            $this->save_cost($salary_cost);
//            $this->save_cost($equipment_cost);
//            $this->save_cost($cost_history);
//            $this->save_cost($items);
//            $this->save_cost($stock);
//            $this->save_cost($stock_history);
//            $this->save_cost($kitchen);
//            $this->save_cost($kitchen_history);
//            $this->save_cost($damage_items);
//            return true;
//        } else {
//            return false;
//        }
//    }

    public function liveStoreData(Request $request) {
        $category_data = urldecode($request->input('data_category'));
        $product_data = urldecode($request->input('data_product'));
        $order_data = urldecode($request->input('data_order'));
        $sales_data = urldecode($request->input('data_sales'));
        $salary_cost_data = urldecode($request->input('data_salary_cost'));
        $equipment_cost_data = urldecode($request->input('data_equipment_cost'));
        $cost_history_data = urldecode($request->input('data_cost_history'));
        $items_data = urldecode($request->input('data_items'));
        $stock_data = urldecode($request->input('data_stock'));
        $stock_history_data = urldecode($request->input('data_stock_history'));
        $kitchen_data = urldecode($request->input('data_kitchen'));
        $kitchen_history_data = urldecode($request->input('data_kitchen_history'));
        $damage_items_data = urldecode($request->input('data_damage_items'));

        $category = json_decode($category_data);
        $products = json_decode($product_data);
        $order = json_decode($order_data);
        $sales = json_decode($sales_data);
        $salary_cost = json_decode($salary_cost_data);
        $equipment_cost = json_decode($equipment_cost_data);
        $cost_history = json_decode($cost_history_data);
        $items = json_decode($items_data);
        $stock = json_decode($stock_data);
        $stock_history = json_decode($stock_history_data);
        $kitchen = json_decode($kitchen_data);
        $kitchen_history = json_decode($kitchen_history_data);
        $damage_items = json_decode($damage_items_data);

        $this->save_category($category);
        $this->save_products($products);
        $this->save_order($order);
        $this->save_sales($sales);
        $this->save_salary_cost($salary_cost);
        $this->save_equipment_cost($equipment_cost);
        $this->save_cost_history($cost_history);
        $this->save_items($items);
        $this->save_stock($stock);
        $this->save_stock_history($stock_history);
        $this->save_kitchen($kitchen);
        $this->save_kitchen_history($kitchen_history);
        $this->save_damage_items($damage_items);
    }

//    public function liveSendData() {
//        $category_data = Category::where('version_number', 0)->orWhere('version_number', 2)->get()->toJson();
//        $product_data = Product::where('version_number', 0)->orWhere('version_number', 2)->get()->toJson();
//        $order_data = Order::where('version_number', 0)->orWhere('version_number', 2)->get()->toJson();
//        $sales_data = Sales::where('version_number', 0)->orWhere('version_number', 2)->get()->toJson();
//        $cost_data = Cost::where('version_number', 0)->orWhere('version_number', 2)->get()->toJson();
//        $fields = array(
//            'data_category' => urlencode($category_data),
//            'data_product' => urlencode($product_data),
//            'data_order' => urlencode($order_data),
//            'data_sales' => urlencode($sales_data),
//            'data_cost' => urlencode($cost_data)
//        );
//        Category::where('version_number', 0)->orWhere('version_number', 2)->update(['version_number' => 1]);
//        Product::where('version_number', 0)->orWhere('version_number', 2)->update(['version_number' => 1]);
//        Order::where('version_number', 0)->orWhere('version_number', 2)->update(['version_number' => 1]);
//        Sales::where('version_number', 0)->orWhere('version_number', 2)->update(['version_number' => 1]);
//        Cost::where('version_number', 0)->orWhere('version_number', 2)->update(['version_number' => 1]);
//        return response()->json($fields);
//    }

    private function save_category($category) {
        foreach ($category as $cat) {
            Category::updateOrCreate([
                'id' => $cat->id
                    ], [
                'category_name' => $cat->category_name,
                'parent_category' => $cat->parent_category,
                'publication_status' => $cat->publication_status,
                'deletation_status' => $cat->deletation_status,
                'created_by' => $cat->created_by,
                'updated_by' => $cat->updated_by,
                'version_number' => 1,
            ]);
        }
        return TRUE;
    }

    private function save_products($products) {
        foreach ($products as $product) {
            Product::updateOrCreate([
                'id' => $product->id
                    ], [
                'product_name' => $product->product_name,
                'product_description' => $product->product_description,
                'product_code' => $product->product_code,
                'product_price' => $product->product_price,
                'product_discount' => $product->product_discount,
                'product_image' => $product->product_image,
                'product_category' => $product->product_category,
                'publication_status' => $product->publication_status,
                'deletation_status' => $product->deletation_status,
                'version_number' => 1,
                'created_by' => $product->created_by,
                'updated_by' => $product->updated_by,
            ]);
        }
        return TRUE;
    }

    private function save_order($order) {
        foreach ($order as $ord) {
            Order::updateOrCreate([
                'id' => $ord->id
                    ], [
                'invoice_number' => $ord->invoice_number,
                'user_id' => $ord->user_id,
                'subtotal' => $ord->subtotal,
                'discount_type' => $ord->discount_type,
                'discount' => $ord->discount,
                'vat' => $ord->vat,
                'service_charge' => $ord->service_charge,
                'grand_total' => $ord->grand_total,
                'receive_amount' => $ord->receive_amount,
                'return_amount' => $ord->return_amount,
                'date' => $ord->date,
                'version_number' => 1,
            ]);
        }
        return TRUE;
    }

    private function save_sales($sales) {
        foreach ($sales as $sale) {
            Sales::updateOrCreate([
                'id' => $sale->id
                    ], [
                'invoice_number' => $sale->invoice_number,
                'product_id' => $sale->product_id,
                'product_code' => $sale->product_code,
                'product_name' => $sale->product_name,
                'quantity' => $sale->quantity,
                'product_price' => $sale->product_price,
                'discount_type' => $sale->discount_type,
                'discount' => $sale->discount,
                'amount' => $sale->amount,
                'user_id' => $sale->user_id,
                'date' => $sale->date,
                'version_number' => 1,
            ]);
        }
        return TRUE;
    }

    private function save_salary_cost($data) {
        foreach ($data as $cost) {
            SalaryCost::updateOrCreate([
            'id' => $cost->id
            ], [
            'employee_name' => $cost->employee_name,
            'month' => $cost->month,
            'amount' => $cost->amount,
            'remark' => $cost->remark,
            'created_by' => $cost->created_by,
            'updated_by' => $cost->updated_by,
            'deletation_status' => $cost->deletation_status,
            'version_number' => 1,
            ]);
        }
        return TRUE;
    }
    private function save_equipment_cost($data) {
        foreach ($data as $cost) {
            EquipmentCost::updateOrCreate([
            'id' => $cost->id
            ], [
            'equipment_name' => $cost->equipment_name,
            'description' => $cost->description,
            'amount' => $cost->amount,
            'created_by' => $cost->created_by,
            'updated_by' => $cost->updated_by,
            'deletation_status' => $cost->deletation_status,
            'version_number' => 1,
            ]);
        }
        return TRUE;
    }
    private function save_cost_history($data) {
        foreach ($data as $cost) {
            CostHistory::updateOrCreate([
            'id' => $cost->id
            ], [
            'title' => $cost->title,
            'amount' => $cost->amount,
            'date' => $cost->date,
            'cost_type' => $cost->cost_type,
            'ref_id' => $cost->ref_id,
            'created_by' => $cost->created_by,
            'updated_by' => $cost->updated_by,
            'deletation_status' => $cost->deletation_status,
            'version_number' => 1,
            ]);
        }
        return TRUE;
    }
    private function save_items($data) {
        foreach ($data as $item) {
            Item::updateOrCreate([
            'id' => $item->id
            ], [
            'item_name' => $item->item_name,
            'unit' => $item->unit,
            'created_by' => $item->created_by,
            'updated_by' => $item->updated_by,
            'deletation_status' => $item->deletation_status,
            'version_number' => 1,
            ]);
        }
        return TRUE;
    }
    private function save_stock($data) {
        foreach ($data as $stock) {
            Stock::updateOrCreate([
            'id' => $stock->id
            ], [
            'item_id' => $stock->item_id,
            'item_name' => $stock->item_name,
            'quantity' => $stock->quantity,
            'unit_price' => $stock->unit_price,
            'remark' => $stock->remark,
            'date' => $stock->date,
            'created_by' => $stock->created_by,
            'updated_by' => $stock->updated_by,
            'deletation_status' => $stock->deletation_status,
            'version_number' => 1,
            ]);
        }
        return TRUE;
    }
    private function save_stock_history($data) {
        foreach ($data as $stock) {
            StockHistory::updateOrCreate([
            'id' => $stock->id
            ], [
            'item_id' => $stock->item_id,
            'item_name' => $stock->item_name,
            'quantity' => $stock->quantity,
            'unit_price' => $stock->unit_price,
            'remark' => $stock->remark,
            'status' => $stock->status,
            'date' => $stock->date,
            'created_by' => $stock->created_by,
            'updated_by' => $stock->updated_by,
            'deletation_status' => $stock->deletation_status,
            'version_number' => 1,
            ]);
        }
        return TRUE;
    }
    private function save_kitchen($data) {
        foreach ($data as $kitchen) {
            Kitchen::updateOrCreate([
            'id' => $kitchen->id
            ], [
            'item_id' => $kitchen->item_id,
            'item_name' => $kitchen->item_name,
            'quantity' => $kitchen->quantity,
            'unit_price' => $kitchen->unit_price,
            'remark' => $kitchen->remark,
            'created_by' => $kitchen->created_by,
            'updated_by' => $kitchen->updated_by,
            'deletation_status' => $kitchen->deletation_status,
            'version_number' => 1,
            ]);
        }
        return TRUE;
    }
    private function save_kitchen_history($data) {
        foreach ($data as $kitchen) {
            KitchenHistory::updateOrCreate([
            'id' => $kitchen->id
            ], [
            'item_id' => $kitchen->item_id,
            'item_name' => $kitchen->item_name,
            'quantity' => $kitchen->quantity,
            'unit_price' => $kitchen->unit_price,
            'remark' => $kitchen->remark,
            'status' => $kitchen->status,
            'date' => $kitchen->date,
            'created_by' => $kitchen->created_by,
            'updated_by' => $kitchen->updated_by,
            'deletation_status' => $kitchen->deletation_status,
            'version_number' => 1,
            ]);
        }
        return TRUE;
    }
    private function save_damage_items($data) {
        foreach ($data as $damage) {
            DamageItem::updateOrCreate([
            'id' => $damage->id
            ], [
            'item_id' => $damage->item_id,
            'item_name' => $damage->item_name,
            'quantity' => $damage->quantity,
            'damage_from' => $damage->damage_from,
            'history_id' => $damage->history_id,
            'remark' => $damage->remark,
            'date' => $damage->date,
            'created_by' => $damage->created_by,
            'updated_by' => $damage->updated_by,
            'deletation_status' => $damage->deletation_status,
            'version_number' => 1,
            ]);
        }
        return TRUE;
    }

    private function checkReachable($url) {
        if ($socket = @ fsockopen($url, 80, $errno, $errstr, 30)) {
            fclose($socket);
            return true;
        } else {
            return false;
        }
    }

}
