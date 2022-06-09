<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckoutProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity')->unsigned()->default(0);
            $table->string('product_sku')->nullable();
            $table->string('product_name')->nullable();
            $table->unsignedInteger('product_attribute_id')->nullable();
            $table->decimal('product_price', 12, 2)->default(0);
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('checkout_id')->unsigned();
            $table->foreign('checkout_id')->references('id')->on('checkouts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkout_product');
    }
}
