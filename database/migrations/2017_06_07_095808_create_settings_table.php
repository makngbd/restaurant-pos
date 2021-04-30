<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyinteger('discount_type')->default(1);
            $table->float('discount')->default(0);
            $table->string('discount_deadline')->nullable();
            $table->float('vat')->default(0);
            $table->float('service_charge')->default(0);
            $table->integer('user_id');
            $table->integer('version_number')->default(0);
            $table->timestamps();
        });
        $settings = new App\Setting([
            'discount_type' => 0,
            'discount' => 0,
            'discount_deadline' => "",
            'vat' => 0,
            'service_charge' => 0,
            'user_id' => 0
        ]); 
        $settings->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
