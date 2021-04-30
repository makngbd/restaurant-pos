<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_costs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('equipment_name');
            $table->text('description')->nullable();
            $table->double('amount');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->boolean('deletation_status')->default(FALSE);
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
        Schema::dropIfExists('equipment_costs');
    }
}
