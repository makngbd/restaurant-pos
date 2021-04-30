<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cost;
use App\SalaryCost;
use App\EquipmentCost;
use App\CostHistory;
use Auth;

class CostController extends Controller {

    public function manageCost() {
        $costs = Cost::where('deletation_status', false)->get();
        return view('admin.pages.manage_cost')
                        ->with([
                            'menu_cost' => true,
                            'costs' => $costs
        ]);
    }

    public function addCost() {
        return view('admin.pages.add_cost')->with(['menu_cost' => true]);
    }

    public function saveCost(Request $request) {
        $this->validate($request, [
            'supplier' => 'required',
            'particular' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);
        if ($request->input('amount') < 0) {
            $request->session()->flash('alert-danger', 'Amount can\'t be negative');
            return redirect()->back();
        }
        $cost = new Cost([
            'supplier' => $request->input('supplier'),
            'particular' => $request->input('particular'),
            'amount' => $request->input('amount'),
            'date' => $request->input('date'),
            'created_by' => Auth::id()
        ]);
        $cost->save();
        return view('admin.pages.add_cost')->with(['success' => 'New Cost Added']);
    }

//    public function editCost($id){
//        $cost = Cost::find($id);
//        return view('admin.pages.edit_cost')->with(['cost' => $cost, 'menu_cost'=> true]);
//    }
//    public function updateCost(Request $request, $id){
//        $this->validate($request, [
//            'supplier' => 'required',
//            'particular' => 'required',
//            'amount' => 'required',
//            'date' => 'required',
//        ]);
//        Cost::where('id', $id)->update([
//            'supplier' => $request->input('supplier'),
//            'particular' => $request->input('particular'),
//            'amount' => $request->input('amount'),
//            'date' => $request->input('date'),
//            'updated_by' => Auth::id(),
//        ]);
//        return view('admin.pages.manage_cost')->with(['menu_cost' => true]);;
//    }
    public function deleteCost($id) {
        Cost::find($id)->update([
            'deletation_status' => true,
            'version_number' => 2,
            'updated_by' => Auth::id(),
            'version_number' => 0
        ]);
        return redirect()->back();
    }

    //Salary Cost
    public function manageSalaryCost() {
        $costs = SalaryCost::where('deletation_status', false)->get();
        return view('admin.pages.manage_salary_cost')
                        ->with([
                            'menu_cost' => true,
                            'menu_salary_cost' => true,
                            'costs' => $costs
        ]);
    }

    public function addSalaryCost() {
        return view('admin.pages.add_salary_cost')
                        ->with([
                            'menu_cost' => true,
                            'menu_salary_cost' => true,
        ]);
    }

    public function saveSalaryCost(Request $request) {
        $this->validate($request, [
            'employee_name' => 'required',
            'month' => 'required',
            'amount' => 'required',
        ]);
        if ($request->input('amount') < 0) {
            $request->session()->flash('alert-danger', 'Amount can\'t be negative');
            return redirect()->back();
        }
        $cost = new SalaryCost([
            'employee_name' => $request->input('employee_name'),
            'month' => $request->input('month'),
            'amount' => $request->input('amount'),
            'remark' => $request->input('remark'),
            'created_by' => Auth::id()
        ]);
        $cost->save();
        $ref_id = $cost->id;
        $cost_h = new CostHistory([
            'title' => $request->input('employee_name'),
            'amount' => $request->input('amount'),
            'date' => date('Y-m-d', strtotime("+6 hours")),
            'cost_type' => 'Salary',
            'ref_id' => $ref_id,
            'created_by' => Auth::id()
        ]);
        $cost_h->save();
        $request->session()->flash('alert-success', 'New salary item was added!');
        return redirect()->back();
    }
    public function deleteSalaryCost($id, Request $request) {
        SalaryCost::find($id)->update([
            'deletation_status' => true,
            'version_number' => 0,
            'updated_by' => Auth::id(),
        ]);
        CostHistory::where('cost_type', 'Salary')->where('ref_id', $id)->update([
            'deletation_status' => true,
            'version_number' => 0,
            'updated_by' => Auth::id(),
        ]);
        $request->session()->flash('alert-warning', '1 item was deleted from Salary Cost!');
        return redirect()->back();
    }

    //Equipment Cost
    public function manageEquipmentCost() {
        $costs = EquipmentCost::where('deletation_status', false)->get();
        return view('admin.pages.manage_equipment_cost')
                        ->with([
                            'menu_cost' => true,
                            'menu_equipment_cost' => true,
                            'costs' => $costs
        ]);
    }

    public function addEquipmentCost() {
        return view('admin.pages.add_equipment_cost')
                        ->with([
                            'menu_cost' => true,
                            'menu_equipment_cost' => true,
        ]);
    }

    public function saveEquipmentCost(Request $request) {
        $this->validate($request, [
            'equipment_name' => 'required',
            'amount' => 'required',
        ]);
        if ($request->input('amount') < 0) {
            $request->session()->flash('alert-danger', 'Amount can\'t be negative');
            return redirect()->back();
        }
        $cost = new EquipmentCost([
            'equipment_name' => $request->input('equipment_name'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
            'created_by' => Auth::id()
        ]);
        $cost->save();
        $ref_id = $cost->id;
        $cost_h = new CostHistory([
            'title' => $request->input('equipment_name'),
            'amount' => $request->input('amount'),
            'date' => date('Y-m-d', strtotime("+6 hours")),
            'cost_type' => 'Equipment',
            'ref_id' => $ref_id,
            'created_by' => Auth::id()
        ]);
        $cost_h->save();
        $request->session()->flash('alert-success', 'New Equipment item was added!');
        return redirect()->back();
    }
    public function deleteEquipmentCost($id, Request $request) {
        EquipmentCost::find($id)->update([
            'deletation_status' => true,
            'version_number' => 0,
            'updated_by' => Auth::id(),
        ]);
        CostHistory::where('cost_type', 'Equipment')->where('ref_id', $id)->update([
            'deletation_status' => true,
            'version_number' => 0,
            'updated_by' => Auth::id(),
        ]);
        $request->session()->flash('alert-warning', '1 item was deleted from Equipment Cost!');
        return redirect()->back();
    }
}
