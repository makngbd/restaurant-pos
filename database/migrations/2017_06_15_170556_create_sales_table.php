<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_number');
            $table->integer('product_id');
            $table->string('product_code');
            $table->string('product_name');
            $table->integer('quantity');
            $table->float('product_price');
            $table->tinyinteger('discount_type');
            $table->float('discount')->default(0);
            $table->float('amount');
            $table->integer('user_id');
            $table->date('date');
            $table->integer('version_number')->default(0);
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
        Schema::dropIfExists('sales');
    }
}
