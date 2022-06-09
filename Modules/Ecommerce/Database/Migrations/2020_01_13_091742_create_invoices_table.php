<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('increment_id')->nullable();
            $table->string('state')->nullable();
            $table->boolean('email_sent')->default(0);
            $table->integer('total_qty')->unsigned()->nullable();
            $table->string('base_currency_code')->nullable();
            $table->string('channel_currency_code')->nullable();
            $table->string('order_currency_code')->nullable();
            $table->decimal('sub_total', 12, 2)->default(0)->nullable();
            $table->decimal('base_sub_total', 12, 2)->default(0)->nullable();
            $table->decimal('grand_total', 12, 2)->default(0)->nullable();
            $table->decimal('base_grand_total', 12, 2)->default(0)->nullable();
            $table->decimal('shipping_amount', 12, 2)->default(0)->nullable();
            $table->decimal('base_shipping_amount', 12, 2)->default(0)->nullable();
            $table->decimal('tax_amount', 12, 2)->default(0)->nullable();
            $table->decimal('base_tax_amount', 12, 2)->default(0)->nullable();
            $table->decimal('discount_amount', 12, 2)->default(0)->nullable();
            $table->decimal('base_discount_amount', 12, 2)->default(0)->nullable();
            $table->integer('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->string('transaction_id')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
