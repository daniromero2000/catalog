<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePawnItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pawn_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('pawn_item_category_id')->unsigned();
            $table->foreign('pawn_item_category_id')->references('id')->on('pawn_item_categories');
            $table->decimal('price', 12, 2)->unsigned()->default(0);
            $table->text('approbed_price')->nullable();
            $table->string('model')->nullable();
            $table->string('brand')->nullable();
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('pawn_item_status_id')->unsigned()->index()->default(1);
            $table->foreign('pawn_item_status_id')->references('id')->on('pawn_item_statuses')->onDelete('cascade');
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pawn_items');
    }
}
