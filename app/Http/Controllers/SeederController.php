<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Sales;
use App\Order;

class SeederController extends Controller {

    public function categoryTableSeeder() {
        $categories = ['Main Dishes', 'Drinks', 'Desert', 'Appetiser', 'Chinese', 'Fast Food'];
        foreach ($categories as $category_name) {
            $category = new Category([
                'category_name' => $category_name,
                'parent_category' => '0',
                'publication_status' => 1,
            ]);
            $category->save();
        }
        return redirect()->back();
    }

    public function productTableSeeder() {
        $products = ["Andy", "Capp's fries", "Bamba", "Beer Nuts", "Balisto", "Bamba", "Bambeanos", "Barcel", "Barny Cakes", "Beer Nuts", "Bell Brand Snack Foods", "Better Made Potato Chips Inc.", "BiFi", "Big D", "Bissli", "Blue Ox Jerky", "BN Biscuit", "Brownie Brittle", "Bugles", "Burry's", "Crunchy-style Cheetos", "A Cosmic Brownie", "Casa Sanchez Foods", "CC's", "Charles Chips", "Chee.Toz", "Cheetos", "Cheez Doodles", "Cheez-It", "Cheezies", "Chex Mix", "Chocodile Twinkie", "Clif Bar", "Combos", "Corn Quistos", "CornNuts", "Cosmic Brownies", "Cottage Double", "Cracker Jack", "Crimpy", "Crispers", "'Nacho Cheese' flavored Doritos", "Devil Dogs", "Ding Dong", "Dolly Madison", "Doritos", "Drake's", "Duyvis", "E.L. Fudge Cookies", "Eagle Snacks", "Funyuns", "Famous Foods of Virginia", "Fiddle Faddle", "Filipinos", "Frazzles", "Fritos", "Fruit by the Foot", "Fruit Gushers", "Fruit Roll-Ups", "Fudge Rounds", "Funyuns", "A Gansito snack cake", "Gansito", "Gardetto's", "Giga Pudding", "Golden Flake", "Golden Wonder", "The Good Bean", "Granny Goose", "Grippo's", "Guiltless Gourmet", "Hadji Bey", "Handi-Snacks", "Haribo Gummy Bears[2]", "Hella Good!", "Herr's Snacks", "Ho Hos", "Hostess", "Hostess CupCake", "Hostess Potato Chips", "Humpty Dumpty Snack Foods", "Hunt's Snack Pack", "Intersnack", "Island Lava", "Cross-section view of a Jaffa Cake", "Jack Link's Beef Jerky", "Jaffa Cakes", "Jays Foods", "Joray Fruit Rolls", "Jos Louis", "Jumbo King", "Keebler Company", "Kettle Foods", "KiMs", "KIND Healthy Snacks", "Kit-Kat[3]", "Koh-Kae", "KP Snacks", "Kryzpo", "Kudos", "Lay's", "Lay's Stax", "Lay's WOW chips", "LesserEvil", "Little Debbie", "Lockets", "Lolly Gobble Bliss Bombs", "Lunchables", "M&M's", "M-Azing", "Maarud", "May West", "McCoy's", "Meanie", "Mighty Munch", "Mike-sell's", "Mister Bee Potato Chips", "Monster Munch", "Mrs. Freshley's", "Munchies", "Munchos", "Nagaraya", "Nik Naks (British snack)", "NikNaks (South African snack)", "Nobby's", "Oreo cookies", "O Hawaii", "Old Dutch Foods", "Oreos", "Otter Pops", "Ouma Rusks", "Pringles potato crisps", "Parker's", "Pantera Rosa", "Peperami", "Pirate's Booty", "Polly", "Pop-Tarts", "Popchips", "Praeventia", "Pringles", "Ketchup-flavored Ruffles potato chips", "Rap Snacks", "Red Hot Riplets", "Red Mill", "Red Sky snacks", "Reese's[4]", "Riceworks", "Rold Gold", "Ruffles", "Sabritas", "Salted Nut Roll", "San Carlo", "Screaming Yellow Zonkers", "Sesame Street snacks", "Sipahh", "Skips", "Slim Jim", "Smartfood", "Smoki", "Snyder's of Berlin", "Snyder's of Hanover", "Snalthy", "Space Raiders", "Starburst[5]", "Sterzing's potato chips", "Sun Chips", "Sunbelt Snacks", "Sunkist Fun Fruits", "A Tokyo Banana", "Tasty Bite", "Tastykake", "Tato Skins", "Tayto (Northern Ireland)", "Tayto (Republic of Ireland)", "Tiger's Milk", "Tigretón", "Tim's Cascade Snacks", "Toaster Strudel", "Tokyo Banana", "Torengos", "Tostitos", "Tracker", "Twiglets", "Twinkie", "Twistees", "Twisties", "Twizzlers", "Takis", "Uncle Ray's", "Utz Quality Foods", "Walkers", "Wazoo", "Wheat Crunchies", "Wheatables", "Wotsits", "Wow! Momo", "Yodels", "Yodels", "Yazoo (drink)", "Zapp's", "Zebra cakes", "Zingers"];
        foreach ($products as $key => $product_name) {
            $product = new Product([
                'product_name' => $product_name,
                'product_description' => 'This is product description for the ' . $product_name,
                'product_code' => str_pad($key + 1, 3, rand(0, 5), STR_PAD_RIGHT) + rand(0, 4),
                'product_price' => rand(20, 200),
                'product_discount' => rand(0, 10),
                'product_image' => 'http://lorempixel.com/400/200/food/' . rand(0, 10),
                'product_category' => rand(1, 5),
                'publication_status' => 1,
                'user_id' => 1
            ]);
            $product->save();
        }
        return redirect()->back();
    }

    public function orderSeeder() {
        $order_count = 10;
        for ($j = 0; $j < $order_count; $j++) {
            $invoice_number = time() . str_pad($j, 4, '0', STR_PAD_LEFT);
            $item = rand(1, 10);
            $subtotal = 0;
            $total_discount = 0;
            for ($i = 0; $i < $item; $i++) {
                $product_id = rand(1, 100);
                $product = Product::find($product_id);
                $quantity = rand(1, 10);
                $amount = $product->product_price * $quantity;
                $discount_type = rand(0, 1);
                $discount = rand(0, 50);
                $total_discount += $discount;
                $subtotal += $amount;
                $sales = new Sales([
                    'invoice_number' => $invoice_number,
                    'product_id' => $product_id,
                    'product_code' => $product->product_code,
                    'product_name' => $product->product_name,
                    'quantity' => $quantity,
                    'product_price' => $product->product_price,
                    'discount_type' => $discount_type,
                    'discount' => $discount,
                    'amount' => $amount,
                    'user_id' => 1,
                    'date' => date('Y-m-d', strtotime("-".$j ." day"))
                ]);
                $sales->save();
            }

            $vat = $subtotal * 0.15;
            $service_charge = $subtotal * 0.05;
            $grand_total = ($subtotal + $vat + $service_charge) - $total_discount;
            $receive_amount = ceil($grand_total / 100) * 100;
            $return_amount = $receive_amount - $grand_total;
            $order = new Order([
                'invoice_number' => $invoice_number,
                'user_id' => 1,
                'subtotal' => $subtotal,
                'discount_type' => $discount_type,
                'discount' => $total_discount,
                'vat' => $vat,
                'service_charge' => $service_charge,
                'grand_total' => $grand_total,
                'receive_amount' => $receive_amount,
                'return_amount' => $return_amount,
            ]);
            $order->save();
        }
        return redirect()->back();
    }

}
