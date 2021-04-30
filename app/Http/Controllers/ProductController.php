<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Category;
use App\Product;
use App\TempOrder;
use App\Order;
use App\Sales;
use App\Setting;
use App\Company;

//use Input;

class ProductController extends Controller {

    public $_term;

    public function manageCategory() {
        $categories = Category::where('deletation_status', false)->orderBy('id', 'desc')->get();
        return view('admin.pages.manage_category')
                        ->with([
                            'menu_category' => true,
                            'categories' => $categories
        ]);
    }

    public function addCategory() {
        $categories = Category::where('publication_status', true)->where('deletation_status', false)->get();
        return view('admin.pages.add_category')
                        ->with([
                            'menu_category' => true,
                            'categories' => $categories
        ]);
    }

    public function saveCategory(Request $request) {
        $this->validate($request, [
            'category_name' => 'required|min:3|unique:categories',
            'parent_category' => 'required'
        ]);
        $category = new Category([
            'category_name' => htmlentities($request->input('category_name')),
            'parent_category' => $request->input('parent_category'),
            'publication_status' => $request->input('publication_status'),
            'created_by' => Auth::id()
        ]);
        $category->save();
        $categories = Category::where('publication_status', true)->where('deletation_status', false)->get();
        return view('admin.pages.add_category')
                        ->with([
                            'success' => 'New Category Added',
                            'categories' => $categories
        ]);
    }

    public function editCategory($id) {
        $category = Category::find($id);
        $categories = Category::where('publication_status', true)->where('deletation_status', false)->get();
        return view('admin.pages.edit_category')
                        ->with([
                            'category' => $category,
                            'categories' => $categories,
                            'menu_category' => true
        ]);
    }

    public function updateCategory(Request $request, $id) {
        $this->validate($request, [
            'category_name' => 'required|min:3',
            'parent_category' => 'required'
        ]);

        Category::where('id', $id)
                ->update([
                    'category_name' => htmlentities($request->input('category_name')),
                    'parent_category' => $request->input('parent_category'),
                    'publication_status' => $request->input('publication_status'),
                    'version_number' => 0,
                    'updated_by' => Auth::id()
        ]);
        return redirect()->route('manage_category');
    }

    public function deleteCategory($id, Request $request) {
        $count_product = Product::where('product_category', $id)->count();
        if ($count_product > 0) {
            $request->session()->flash('alert-danger', 'Can\'t delete. The category is not empty. There are ' . $count_product . ' product(s) in this category.');
        } else {
            Category::where('id', $id)->delete();
        }
        return redirect()->route('manage_category');
    }

    public function manageProduct() {
        $categories = Category::where('deletation_status', false)->get();
        $products = Product::where('deletation_status', false)->orderBy('id', 'desc')->get();
        return view('admin.pages.manage_product')
                        ->with([
                            'menu_product' => true,
                            'categories' => $categories,
                            'products' => $products
        ]);
    }

    public function addProduct() {
        $categories = Category::where('publication_status', true)->where('deletation_status', false)->get();
        return view('admin.pages.add_product')
                        ->with([
                            'menu_product' => true,
                            'categories' => $categories
        ]);
    }

    public function saveProduct(Request $request) {
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required|min:0',
            'product_code' => 'required|unique:products',
            'product_image' => 'max:200',
        ]);
        if (Input::hasFile('product_image')) {
            $image = Input::file('product_image');
            $image_name = 'uploads/' . time() . $image->getClientOriginalName();
            $image->move('uploads', $image_name);
        } else {
            $image_name = 'public/admin/img/image-not-available.jpg';
        }
        $product = new Product([
            'product_name' => htmlentities($request->input('product_name')),
            'product_description' => $request->input('product_description'),
            'product_code' => $request->input('product_code'),
            'product_price' => $request->input('product_price'),
            'product_discount' => $request->input('product_discount'),
            'product_image' => $image_name,
            'product_category' => $request->input('product_category'),
            'publication_status' => $request->input('publication_status'),
            'created_by' => Auth::id()
        ]);
        $product->save();
        $categories = Category::where('publication_status', true)->where('deletation_status', false)->get();
        return view('admin.pages.add_product')->with([
                    'success' => 'New Product Added',
                    'categories' => $categories
        ]);
    }

    public function editProduct($id) {
        $product = Product::find($id);
        $categories = Category::where('publication_status', true)->where('deletation_status', false)->get();
        return view('admin.pages.edit_product')
                        ->with([
                            'product' => $product,
                            'categories' => $categories,
                            'menu_product' => true
        ]);
    }

    public function updateProduct(Request $request, $id) {
        $this->validate($request, [
            'product_name' => 'required',
            'product_price' => 'required|min:0',
            'product_code' => 'required',
            'product_image' => 'max:200',
        ]);
        $old_image = Product::find($id)->product_image;
        if (Input::hasFile('product_image')) {
            $image = Input::file('product_image');
            $image_name = 'uploads/' . time() . $image->getClientOriginalName();
            $image->move('uploads', $image_name);
            if (file_exists($old_image)) {
                unlink($old_image);
            }
        } else {
            $image_name = $old_image;
        }
        Product::where('id', $id)
                ->update([
                    'product_name' => htmlentities($request->input('product_name')),
                    'product_description' => $request->input('product_description'),
                    'product_code' => $request->input('product_code'),
                    'product_price' => $request->input('product_price'),
                    'product_discount' => $request->input('product_discount'),
                    'product_image' => $image_name,
                    'product_category' => $request->input('product_category'),
                    'publication_status' => $request->input('publication_status'),
                    'version_number' => 0,
                    'updated_by' => Auth::id()
        ]);
        return redirect()->route('manage_product');
    }

    public function deleteProduct($id) {
        Product::where('id', $id)->delete();
        return redirect()->route('manage_product');
    }

    public function getOrder() {
        return view('admin.pages.order')->with(['menu_order' => true]);
    }

    public function searchProduct(Request $request) {
        $this->_term = $request->term;
        $products = Product::where('publication_status', TRUE)
                ->where('deletation_status', false)
                ->where(function($query) {
                    $query->where('product_name', 'LIKE', '%' . $this->_term . '%')
                    ->orwhere('product_code', 'LIKE', '%' . $this->_term . '%');
                })
                ->take(10)
                ->get();

        $results = array();
        foreach ($products as $product) {
            $results[] = ['id' => $product->id, 'value' => $product->product_code . " " . $product->product_name];
        }
        return response()->json($results);
    }

    public function addItemToOrder(Request $request) {
        $this->validate($request, [
            'product_id' => 'required',
            'quantity' => 'required|integer|between:1,10000'
        ]);
        TempOrder::updateOrCreate(
                ['product_id' => $request->input('product_id'), 'user_id' => Auth::id()], ['quantity' => $request->input('quantity')]
        );
        return redirect()->back();
    }

    public function removeItemFromOrder($id) {
        TempOrder::find($id)->delete();
        return redirect()->back();
    }

    public function cancelOrder() {
        TempOrder::where('user_id', Auth::id())->delete();
        return redirect()->back();
    }

    public function processOrder(Request $request) {
        $this->validate($request, [
            'receive_amount' => 'required'
        ]);

        if ($request->input('check_extra_discount')) {
            $this->validate($request, [
                'extra_discount' => 'required'
            ]);
            if ($request->input('extra_discount') > $request->input('grand_total')) {
                return view('admin.pages.order')
                                ->with([
                                    'error' => 'Extra Discount can\'t be grater than Grand total'
                ]);
            }
            if (($request->input('receive_amount') + $request->input('extra_discount')) < $request->input('grand_total')) {
                return view('admin.pages.order')
                                ->with([
                                    'error' => 'Insufficient Receieve Amount'
                ]);
            }
        } else {
            if ($request->input('receive_amount') < $request->input('grand_total')) {
                return view('admin.pages.order')
                                ->with([
                                    'error' => 'Insufficient Receieve Amount'
                ]);
            }
        }

        $invoice_number = time() . str_pad(Auth::id(), 4, '0', STR_PAD_LEFT);
        $orders = TempOrder::where('user_id', Auth::id())->get();
        $subtotal = 0;
        $total_discount = 0;
        $settings = Setting::all()->last();
        $discount_type = $settings->discount_type;

        foreach ($orders as $order) {
            $product = Product::find($order->product_id);

            $quantity = $order->quantity;
            $price = $product->product_price;
            $amount = $price * $quantity;
            $product_discount = $product->product_discount;
            if (!$discount_type) {
                $discount = 0;
                if ($settings->discount_deadline > date('Y-m-d')) {
                    $discount = ($settings->discount / 100) * $amount;
                }
            } else {
                $discount = $product_discount * $quantity;
            }
            $subtotal += $amount;
            $total_discount += $discount;

            $sales = new Sales([
                'invoice_number' => $invoice_number,
                'product_id' => $product->id,
                'product_code' => $product->product_code,
                'product_name' => $product->product_name,
                'quantity' => $quantity,
                'product_price' => $price,
                'discount_type' => $discount_type,
                'discount' => $discount,
                'amount' => $amount,
                'user_id' => Auth::id(),
                'date' => date('Y-m-d', strtotime("+6 hours"))
            ]);
            $sales->save();
        }
        $vat = ($settings->vat / 100) * $subtotal;
        $service_charge = ($settings->service_charge / 100) * $subtotal;
        $grand_total = ($subtotal + $vat + $service_charge) - $total_discount;
        $extra_discount = $request->input('extra_discount');
        $discount_reference = $request->input('discount_reference');
        $receive_amount = $request->input('receive_amount');
        $return_amount = $receive_amount + $extra_discount - $grand_total;
        $order = new Order([
            'invoice_number' => $invoice_number,
            'user_id' => Auth::user()->id,
            'subtotal' => $subtotal,
            'discount_type' => $discount_type,
            'discount' => $total_discount,
            'extra_discount' => $extra_discount,
            'discount_reference' => $discount_reference,
            'vat' => $vat,
            'service_charge' => $service_charge,
            'grand_total' => $grand_total,
            'receive_amount' => $receive_amount,
            'return_amount' => $return_amount,
            'date' => date('Y-m-d', strtotime("+6 hours"))
        ]);
        $order->save();
        $this->cancelOrder();
        return redirect()->route('invoice', ['id' => $invoice_number]);
    }

    public function getInvoiceList() {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.pages.invoice_list')
                        ->with([
                            'menu_invoice' => true,
                            'orders' => $orders
        ]);
    }

    public function getInvoice($invoice_number) {
        $company_profile = Company::get()->last();
        $order = Order::where('invoice_number', $invoice_number)->first();
        $sales = Sales::where('invoice_number', $invoice_number)->get();
        return view('admin.pages.invoice')
                        ->with([
                            'order' => $order,
                            'sales' => $sales,
                            'company_profile' => $company_profile,
                            'menu_invoice' => true
        ]);
    }

}
