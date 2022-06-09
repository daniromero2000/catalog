<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned()->index();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedInteger('product_attribute_id')->nullable();
            $table->integer('quantity')->unsigned()->default(0);
            $table->integer('qty_shipped')->unsigned()->default(0)->nullable();
            $table->integer('qty_invoiced')->unsigned()->default(0)->nullable();
            $table->integer('qty_canceled')->unsigned()->default(0)->nullable();
            $table->integer('qty_refunded')->unsigned()->default(0)->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_sku')->nullable();
            $table->text('product_description')->nullable();
            $table->decimal('product_price', 12, 2)->default(0)->nullable();
            $table->string('coupon_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
    }
}
