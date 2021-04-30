<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Stock;
use App\Kitchen;
use App\StockHistory;
use App\KitchenHistory;
use App\DamageItem;
use App\CostHistory;
use Auth;
use DB;

class InventoryController extends Controller {

    public function manageItems() {
        $items = Item::where('deletation_status', FALSE)->orderBy('id', 'desc')->get();
        return view('admin.pages.manage_items')
                        ->with([
                            'items' => $items,
                            'menu_inventory' => true,
                            'menu_items' => true,
        ]);
    }

    public function addItem() {
        return view('admin.pages.add_item')
                        ->with([
                            'menu_inventory' => true,
                            'menu_items' => true,
        ]);
    }

    public function saveItem(Request $request) {
        $this->validate($request, [
            'item_name' => 'required|unique:items',
            'unit' => 'required',
        ]);
        $item = new Item([
            'item_name' => $request->input('item_name'),
            'unit' => $request->input('unit'),
            'created_by' => Auth::id()
        ]);
        $item->save();
        $request->session()->flash('alert-success', $request->input('item_name') . ' was added successfully!');
        return redirect()->route("add_item");
    }

    public function editItem($id) {
        $item = item::find($id);
        return view('admin.pages.edit_item')->with(['item' => $item, 'menu_item' => true]);
    }

    public function updateItem(Request $request, $id) {
        $this->validate($request, [
            'item_name' => 'required',
            'unit' => 'required',
        ]);
        Item::where('id', $id)->update([
            'item_name' => $request->input('item_name'),
            'unit' => $request->input('unit'),
            'updated_by' => Auth::id(),
            'version_number' => 0
        ]);
        $request->session()->flash('alert-success', $request->input('item_name') . ' was updated successfully!');
        return redirect()->route('manage_items');
    }

    public function deleteItem($id, Request $request) {
        $item = Item::find($id);
        $item->update([
            'deletation_status' => true,
            'updated_by' => Auth::id(),
            'version_number' => 0
        ]);
        $request->session()->flash('alert-info', $item->item_name . ' was deleted successfully!');
        return redirect()->back();
    }

    public function manageStock() {
        $stocks = Stock::where('deletation_status', FALSE)->orderBy('id', 'desc')->get();
        return view('admin.pages.manage_stock')
                        ->with([
                            'stocks' => $stocks,
                            'menu_inventory' => true,
                            'menu_stock' => true,
        ]);
    }

    public function addStock() {
        $items = Item::where('deletation_status', false)->get();
        return view('admin.pages.add_stock')
                        ->with([
                            'items' => $items,
                            'menu_inventory' => true,
                            'menu_stock' => true,
        ]);
    }

    public function saveStock(Request $request) {
        $this->validate($request, [
            'item_id' => 'required',
            'quantity' => 'required',
            'total_price' => 'required',
            'date' => 'required',
        ]);
        $quantity = $request->input('quantity');
        $total_price = $request->input('total_price');
        if ($quantity <= 0) {
            $request->session()->flash('alert-danger', 'Quantity can\'t be negative or 0');
            return redirect()->back();
        }
        if ($total_price <= 0) {
            $request->session()->flash('alert-danger', 'Total Price can\'t be negative or 0');
            return redirect()->back();
        }

        $item_name = Item::find($request->input('item_id'))->item_name;
        $stock_h = new StockHistory([
            'item_id' => $request->input('item_id'),
            'item_name' => $item_name,
            'quantity' => $request->input('quantity'),
            'total_price' => $total_price,
            'remark' => $request->input('remark'),
            'status' => 'entry',
            'date' => $request->input('date'),
            'created_by' => Auth::id()
        ]);
        $stock_h->save();
        $ref_id = $stock_h->id;
        $cost_h = new CostHistory([
            'title' => $item_name,
            'amount' => $total_price,
            'date' => date('Y-m-d', strtotime('+6 hours')),
            'cost_type' => 'Stock',
            'ref_id' => $ref_id,
            'created_by' => Auth::id()
        ]);
        $cost_h->save();
        Stock::updateOrCreate([
            'item_id' => $request->input('item_id')
                ], [
            'item_id' => $request->input('item_id'),
            'item_name' => $item_name,
            'quantity' => DB::raw('quantity + ' . $request->input('quantity')),
            'total_price' => $request->input('total_price'),
            'remark' => $request->input('remark'),
            'date' => $request->input('date'),
            'created_by' => Auth::id(),
            'version_number' => 0
        ]);
        $request->session()->flash('alert-success', 'New Stock added successfully!');
        return redirect()->route("add_stock");
    }

//    public function editStock($id) {
//        $items = Item::where('deletation_status', false)->get();
//        $stock = Stock::find($id);
//        return view('admin.pages.edit_stock')
//                        ->with([
//                            'items' => $items,
//                            'stock' => $stock,
//                            'menu_stock' => true
//        ]);
//    }
//
//    public function updateStock(Request $request, $id) {
//        $this->validate($request, [
//            'item_id' => 'required',
//            'quantity' => 'required',
//            'unit_price' => 'required',
//            'date' => 'required',
//        ]);
//        $item_name = Item::find($request->input('item_id'))->item_name;
//        Stock::where('id', $id)->update([
//            'item_id' => $request->input('item_id'),
//            'item_name' => $item_name,
//            'quantity' => $request->input('quantity'),
//            'unit_price' => $request->input('unit_price'),
//            'remark' => $request->input('remark'),
//            'date' => $request->input('date'),
//            'updated_by' => Auth::id()
//        ]);
//        $request->session()->flash('alert-success', 'Stock updated successfully!');
//        return redirect()->route('manage_stock');
//    }

    public function deleteStock($id, Request $request) {
        $stock_history = StockHistory::find($id);
        $stock = Stock::where('item_id', $stock_history->item_id)->first();
        if ($stock_history->quantity > $stock->quantity) {
            $request->session()->flash('alert-danger', 'Item quantity already used or not available in Stock!');
            return redirect()->back();
        }
        $stock_history->update([
            'deletation_status' => true,
            'updated_by' => Auth::id(),
            'version_number' => 0
        ]);
        $stock->update([
            'quantity' => DB:: raw('quantity - ' . $stock_history->quantity),
            'updated_by' => Auth::id(),
            'version_number' => 0
        ]);
        CostHistory::where('ref_id', $id)->update(['deletation_status'=> true]);
        $request->session()->flash('alert-info', '1 item deleted from Stock!');
        return redirect()->back();
    }

    public function stockEntryList() {
        $stocks = StockHistory::where('deletation_status', false)->where('status', 'entry')->orderBy('id', 'desc')->get();
        return view('admin.pages.stock_entry_list')
                        ->with([
                            'stocks' => $stocks,
                            'menu_inventory' => true,
                            'menu_stock' => true,
        ]);
    }

    //Kitchen Stock
    public function kitchenStock() {
        $k_stocks = Kitchen::where('deletation_status', FALSE)->orderBy('id', 'desc')->get();
        return view('admin.pages.kitchen_stock')
                        ->with([
                            'k_stocks' => $k_stocks,
                            'menu_inventory' => true,
                            'menu_kitchen' => true
        ]);
    }

    public function addKitchenStock() {
        $items = Item::where('deletation_status', false)->get();
        return view('admin.pages.add_kitchen_stock')
                        ->with([
                            'items' => $items,
                            'menu_inventory' => true,
                            'menu_kitchen' => true,
        ]);
    }

    public function saveKitchenStock(Request $request) {
        $this->validate($request, [
            'item_id' => 'required',
            'quantity' => 'required',
            'total_price' => 'required',
            'date' => 'required',
        ]);
        $item_id = $request->input('item_id');
        $quantity = $request->input('quantity');
        $total_price = $request->input('total_price');
        $remark = $request->input('remark');
        if ($quantity <= 0) {
            $request->session()->flash('alert-danger', 'Quantity can\'t be negative or 0');
            return redirect()->back();
        }
        if ($total_price <= 0) {
            $request->session()->flash('alert-danger', 'Unit Price can\'t be negative or 0');
            return redirect()->back();
        }

        $item_name = Item::find($request->input('item_id'))->item_name;
        $stock_h = new StockHistory([
            'item_id' => $item_id,
            'item_name' => $item_name,
            'quantity' => $quantity,
            'total_price' => $total_price,
            'remark' => $remark,
            'status' => 'entry',
            'date' => $request->input('date'),
            'created_by' => Auth::id(),
            'version_number' => 0
        ]);
        $stock_h->save();
        $ref_id = $stock_h->id;
        $stock_h = new StockHistory([
            'item_id' => $item_id,
            'item_name' => $item_name,
            'quantity' => $quantity,
            'total_price' => $total_price,
            'remark' => $remark,
            'status' => 'delivered',
            'date' => $request->input('date'),
            'created_by' => Auth::id(),
            'version_number' => 0
        ]);
        $stock_h->save();
        $cost_h = new CostHistory([
            'title' => $item_name,
            'amount' => $total_price,
            'date' => date('Y-m-d', strtotime('+6 hours')),
            'cost_type' => 'Stock',
            'ref_id' => $ref_id,
            'created_by' => Auth::id(),
            'version_number' => 0
        ]);
        $cost_h->save();
        Stock::updateOrCreate([
            'item_id' => $item_id
                ], [
            'item_id' => $item_id,
            'item_name' => $item_name,
            'quantity' => DB::raw('quantity'),
            'total_price' => $total_price,
            'remark' => $remark,
            'date' => $request->input('date'),
            'created_by' => Auth::id(),
            'version_number' => 0
        ]);

        $k_history = new KitchenHistory([
            'item_id' => $item_id,
            'item_name' => $item_name,
            'quantity' => $quantity,
            'total_price' => $total_price,
            'status' => 'entry',
            'remark' => $remark,
            'date' => date('Y-m-d', strtotime('+6 hours')),
            'created_by' => Auth::id(),
            'version_number' => 0
        ]);
        $k_history->save();
        Kitchen::updateOrCreate([
            'item_id' => $item_id
                ], [
            'item_id' => $item_id,
            'item_name' => $item_name,
            'quantity' => DB::raw('quantity + ' . $quantity),
            'total_price' => $total_price,
            'remark' => $remark,
            'created_by' => Auth::id(),
            'version_number' => 0
        ]);
        $request->session()->flash('alert-success', 'New Item directly added to Kitchen Stock!');
        return redirect()->back();
    }

    public function searchItem(Request $request) {
        $term = $request->term;
        $stocks = Stock::where('deletation_status', FALSE)
                ->where('item_name', 'LIKE', '%' . $term . '%')
                ->take(10)
                ->get();

        $results = array();
        foreach ($stocks as $stock) {
            $item = Item::find($stock->item_id);
            $results[] = ['id' => $stock->item_id, 'value' => $stock->item_name, 'quantity' => $stock->quantity, 'unit' => $item->unit];
        }
        return response()->json($results);
    }

    public function addItemToKitchen(Request $request) {
        $this->validate($request, [
            'item_id' => 'required',
            'quantity' => 'required'
        ]);

        $item_id = $request->input('item_id');
        $new_quantity = $request->input('quantity');
        $new_unit = $request->input('unit');
        $item_stock = Stock::where('item_id', $item_id)->first();
        $stock_quantity = $item_stock->quantity;
        $item_kitchen = Kitchen::where('item_id', $item_id)->first();
        $item = Item::find($item_id);

        //Check valid quantity
        if ($new_quantity <= 0) {
            $request->session()->flash('alert-danger', 'Quantity can\'t be negative or 0');
            return redirect()->back();
        }

        //Check Correct Unit
        if ($new_unit != $item->unit) {
            if (!(($new_unit == 'gm' && $item->unit == 'kg') || ($new_unit == 'ml' && $item->unit == 'litre'))) {
                $request->session()->flash('alert-danger', 'Please select valid unit!');
                return redirect()->back();
            }
        }

        //Generalize Quantity
        if ($new_unit == 'gm') {
            $new_quantity = $new_quantity / 1000;
            $new_unit = 'kg';
        }
        if ($new_unit == 'ml') {
            $new_quantity = $new_quantity / 1000;
            $new_unit = 'litre';
        }
        $s_quantity = $stock_quantity - $new_quantity;

        //Check Stock Availability
        if ($new_quantity > $stock_quantity) {
            $request->session()->flash('alert-danger', 'Quantity out of stock!');
            return redirect()->back();
        }
        //check item in kitchen or not
        if ($item_kitchen) {
            //item already in Kitchen
            Kitchen::where('item_id', $item_id)->update([
                'quantity' => DB::raw('quantity + ' . $new_quantity),
                'updated_by' => Auth::id(),
                'version_number' => 0
            ]);

            $request->session()->flash('alert-success', $item_stock->item_name . ' quantity increased!');
        } else {
            //New Item
            $new_item = new Kitchen([
                'item_id' => $item_id,
                'item_name' => $item_stock->item_name,
                'quantity' => $new_quantity,
                'total_price' => $item_stock->total_price,
                'remark' => $item_stock->remark,
                'created_by' => Auth::id()
            ]);
            $new_item->save();
            $request->session()->flash('alert-success', $item_stock->item_name . ' was added!');
        }
        $k_history = new KitchenHistory([
            'item_id' => $item_id,
            'item_name' => $item_stock->item_name,
            'quantity' => $new_quantity,
            'total_price' => $item_stock->total_price,
            'status' => 'entry',
            'remark' => $item_stock->remark,
            'date' => date('Y-m-d', strtotime('+6 hours')),
            'created_by' => Auth::id()
        ]);
        $k_history->save();
        Stock::where('item_id', $item_id)->update([
            'quantity' => DB::raw('quantity - ' . $new_quantity),
            'updated_by' => Auth::id(),
            'version_number' => 0
        ]);
        $s_history = new StockHistory([
            'item_id' => $item_id,
            'item_name' => $item_stock->item_name,
            'quantity' => $new_quantity,
            'total_price' => $item_stock->total_price,
            'status' => 'delivered',
            'remark' => $item_stock->remark,
            'date' => date('Y-m-d', strtotime('+6 hours')),
            'created_by' => Auth::id()
        ]);
        $s_history->save();
        return redirect()->back();
    }

    public function returnItem(Request $request) {
        $this->validate($request, [
            'item_id' => 'required',
            'quantity' => 'required'
        ]);
        if ($request->input('quantity') <= 0) {
            $request->session()->flash('alert-danger', 'Quantity can\'t be negative or 0');
            return redirect()->back();
        }
        $item_id = $request->input('item_id');
        $item_name = Item::find($item_id)->item_name;
        $quantity = $request->input('quantity');
        //Check valid quantity
        if ($quantity <= 0) {
            $request->session()->flash('alert-danger', 'Quantity can\'t be negative or 0');
            return redirect()->back();
        }
        $k_quantity = Kitchen::where('item_id', $item_id)->first()->quantity;
        //check quantity available
        if ($quantity > $k_quantity) {
            $request->session()->flash('alert-danger', 'Item quantity not available to return');
            return redirect()->back();
        }
        Kitchen::where('item_id', $item_id)->update([
            'quantity' => DB::raw('quantity - ' . $quantity),
            'updated_by' => Auth::id(),
            'version_number' => 0
        ]);

        Stock::where('item_id', $item_id)->update([
            'quantity' => DB::raw('quantity +' . $quantity),
            'updated_by' => Auth::id(),
            'version_number' => 0
        ]);
        $k_history = new KitchenHistory([
            'item_id' => $item_id,
            'item_name' => $item_name,
            'quantity' => $quantity,
            'status' => 'return',
            'date' => date('Y-m-d', strtotime('+6 hours')),
            'created_by' => Auth::id()
        ]);
        $k_history->save();
        $s_history = new StockHistory([
            'item_id' => $item_id,
            'item_name' => $item_name,
            'quantity' => $quantity,
            'status' => 'back',
            'date' => date('Y-m-d', strtotime('+6 hours')),
            'created_by' => Auth::id()
        ]);
        $s_history->save();
        $request->session()->flash('alert-success', 'Item returned');
        return redirect()->back();
    }

    public function damageItems() {
        $damage_items = DamageItem::where('deletation_status', FALSE)->orderBy('id', 'desc')->get();
        return view('admin.pages.damage_items')
                        ->with([
                            'menu_inventory' => true,
                            'menu_damage' => true,
                            'damage_items' => $damage_items
        ]);
    }

    public function addDamageItem() {
        $items = Item::where('deletation_status', false)->get();
        return view('admin.pages.add_damage_item')
                        ->with([
                            'items' => $items,
                            'menu_inventory' => true,
                            'menu_damage' => true,
        ]);
    }

    public function saveDamageItem(Request $request) {
        $item_id = $request->input('item_id');
        $item_name = Item::find($item_id)->item_name;
        $item_quantity = $request->input('quantity');

        if ($request->input('damage_from') == 'Warehouse') {
            $s_item = Stock::where('item_id', $item_id)->first();
            if (!$s_item) {
                $request->session()->flash('alert-danger', 'Item doesn\'t exist in Warehouse Stock!');
                return redirect()->back();
            }
            $stock_quantity = $s_item->quantity;
            if ($item_quantity > $stock_quantity) {
                $request->session()->flash('alert-danger', 'Item quantity not available in Warehouse Stock!');
                return redirect()->back();
            }
            Stock::where('item_id', $item_id)->update([
                'quantity' => DB::raw('quantity - ' . $item_quantity),
                'updated_by' => Auth::id(),
                'version_number' => 0
            ]);
            $s_history = new StockHistory([
                'item_id' => $item_id,
                'item_name' => $item_name,
                'quantity' => $item_quantity,
                'status' => 'damaged',
                'date' => date('Y-m-d', strtotime('+6 hours')),
                'created_by' => Auth::id()
            ]);
            $s_history->save();
            $history_id = $s_history->id;
        } else if ($request->input('damage_from') == 'Kitchen') {
            $k_item = Kitchen::where('item_id', $item_id)->first();
            if (!$k_item) {
                $request->session()->flash('alert-danger', 'Item doesn\'t exist in Kitchen Stock!');
                return redirect()->back();
            }
            $kitchen_quantity = $k_item->quantity;
            if ($item_quantity > $kitchen_quantity) {
                $request->session()->flash('alert-danger', 'Item quantity not available in Kitchen!');
                return redirect()->back();
            }
            Kitchen::where('item_id', $item_id)->update([
                'quantity' => DB::raw('quantity - ' . $item_quantity),
                'updated_by' => Auth::id(),
                'version_number' => 0
            ]);
            $k_history = new KitchenHistory([
                'item_id' => $item_id,
                'item_name' => $item_name,
                'quantity' => $item_quantity,
                'status' => 'damaged',
                'date' => date('Y-m-d', strtotime('+6 hours')),
                'created_by' => Auth::id()
            ]);
            $k_history->save();
            $history_id = $k_history->id;
        } else {
            $request->session()->flash('alert-danger', 'Something went wrong!');
            return redirect()->back();
        }
        $damage_item = new DamageItem([
            'item_id' => $item_id,
            'item_name' => $item_name,
            'quantity' => $item_quantity,
            'damage_from' => $request->input('damage_from'),
            'history_id' => $history_id,
            'remark' => $request->input('remark'),
            'date' => $request->input('date'),
            'created_by' => Auth::id()
        ]);
        $damage_item->save();
        $request->session()->flash('alert-success', $item_name . ' added as a damage item!');
        return redirect()->back();
    }

    public function deleteDamageItem($id, Request $request) {
        $damage_item = DamageItem::find($id);
        $item_id = $damage_item->item_id;
        $item_name = $damage_item->item_name;
        $item_quantity = $damage_item->quantity;

        if ($damage_item->damage_from == 'Warehouse') {
            Stock::where('item_id', $item_id)->update([
                'quantity' => DB::raw('quantity + ' . $item_quantity),
                'updated_by' => Auth::id(),
                'version_number' => 0
            ]);
            StockHistory::find($damage_item->history_id)->update([
                'deletation_status' => true,
                'updated_by' => Auth::id(),
                'version_number' => 0
            ]);
        } else if ($damage_item->damage_from == 'Kitchen') {
            Kitchen::where('item_id', $item_id)->update([
                'quantity' => DB::raw('quantity + ' . $item_quantity),
                'updated_by' => Auth::id(),
                'version_number' => 0
            ]);
            KitchenHistory::find($damage_item->history_id)->update([
                'deletation_status' => true,
                'updated_by' => Auth::id(),
                'version_number' => 0
            ]);
        }
        $damage_item->update([
            'deletation_status' => true,
            'updated_by' => Auth::id(),
            'version_number' => 0
        ]);
        $request->session()->flash('alert-success', $item_name . ' deleted from damage items!');
        return redirect()->back();
    }

}
