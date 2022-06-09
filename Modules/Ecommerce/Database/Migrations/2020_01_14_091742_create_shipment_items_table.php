<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('sku')->nullable();
            $table->integer('qty')->unsigned()->nullable()->default(0);
            $table->integer('weight')->unsigned()->nullable()->default(0);
            $table->decimal('price', 12, 2)->default(0)->nullable();
            $table->decimal('base_price', 12, 2)->default(0)->nullable();
            $table->decimal('total', 12, 2)->default(0)->nullable();
            $table->decimal('base_total', 12, 2)->default(0)->nullable();
            $table->integer('shipment_id')->unsigned();
            $table->foreign('shipment_id')->references('id')->on('shipments')->onDelete('cascade');
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
        Schema::dropIfExists('shipment_items');
    }
}
