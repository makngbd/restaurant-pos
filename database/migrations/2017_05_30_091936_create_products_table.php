<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name');
            $table->text('product_description')->nullable();
            $table->string('product_code');
            $table->float('product_price', 8, 2);
            $table->float('product_discount', 5, 2)->nullable();
            $table->string('product_image')->nullable();
            $table->integer('product_category');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->boolean('publication_status');
            $table->boolean('deletation_status')->default(false);
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
        Schema::dropIfExists('products');
    }
}
