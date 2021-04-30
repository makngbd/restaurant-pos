<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_number');
            $table->integer('user_id');
            $table->double('subtotal');
            $table->boolean('discount_type');
            $table->float('discount');
            $table->float('extra_discount')->nullable();
            $table->string('discount_reference')->nullable();
            $table->float('vat');
            $table->float('service_charge');
            $table->double('grand_total');
            $table->float('receive_amount');
            $table->float('return_amount');
            $table->integer('version_number')->default(0);
            $table->date('date');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
