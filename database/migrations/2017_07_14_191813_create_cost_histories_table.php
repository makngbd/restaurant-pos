<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->double('amount');
            $table->date('date');
            $table->string('cost_type');
            $table->integer('ref_id');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->string('deletation_status')->default(FALSE);
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
        Schema::dropIfExists('cost_histories');
    }
}
