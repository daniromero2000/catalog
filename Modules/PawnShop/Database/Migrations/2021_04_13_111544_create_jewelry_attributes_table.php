<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJewelryAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pawn_item_jewelry_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jewelry_quality_id')->unsigned();
            $table->foreign('jewelry_quality_id')->references('id')->on('jewelry_qualities')->onDelete('cascade');
            $table->decimal('weight', 12, 2)->unsigned()->default(0);
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
        Schema::dropIfExists('jewelry_attributes');
    }
}
