<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pawn_item_vehicles_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fasecolda_code')->nullable();
            $table->integer('pawn_item_id')->unsigned();
            $table->foreign('pawn_item_id')->references('id')->on('pawn_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles_attributes');
    }
}
