<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faults', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fault_type_id');
            $table->integer('region_id');
            $table->integer('sub_city_zone_id');
            $table->integer('woreda_city_id');
            $table->string('specific_name');
            $table->string('sender_phone');
            $table->integer('code')->unique();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('faults');
    }
}
