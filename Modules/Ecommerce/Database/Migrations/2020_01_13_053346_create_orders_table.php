<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference')->unique();
            $table->integer('courier_id')->unsigned()->index();
            $table->foreign('courier_id')->references('id')->on('couriers');
            $table->integer('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('address_id')->unsigned()->index();
            $table->foreign('address_id')->references('id')->on('customer_addresses');
            $table->integer('order_status_id')->unsigned()->index();
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
            $table->string('payment')->default('No Payment');
            $table->decimal('discounts', 12, 2)->default(0);
            $table->decimal('discount_percent', 12, 2)->default(0)->nullable();
            $table->decimal('discount_amount', 12, 2)->default(0)->nullable();
            $table->decimal('base_discount_amount', 12, 2)->default(0)->nullable();
            $table->decimal('discount_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('base_discount_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('discount_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('base_discount_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('sub_total', 12, 2)->default(0);
            $table->decimal('base_sub_total', 12, 2)->default(0)->nullable();
            $table->decimal('sub_total_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('base_sub_total_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('sub_total_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('base_sub_total_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('total_shipping', 12, 2)->default(0)->nullable();
            $table->decimal('base_shipping_amount', 12, 2)->default(0)->nullable();
            $table->decimal('shipping_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('base_shipping_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('shipping_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('base_shipping_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('shipping_discount_amount', 12, 2)->default(0)->nullable();
            $table->decimal('base_shipping_discount_amount', 12, 2)->default(0)->nullable();
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('base_tax_amount', 12, 2)->default(0)->nullable();
            $table->decimal('tax_amount_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('base_tax_amount_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('tax_amount_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('base_tax_amount_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('grand_total', 12, 2)->default(0);
            $table->decimal('base_grand_total', 12, 2)->default(0)->nullable();
            $table->decimal('grand_total_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('base_grand_total_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('grand_total_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('base_grand_total_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('total_paid', 12, 2)->default(0)->nullable();
            $table->string('invoice')->nullable()->default('No Invoice');
            $table->string('label_url')->nullable()->default('No URL');
            $table->string('coupon_code')->nullable();
            $table->boolean('is_gift')->default(0);
            $table->string('base_currency_code')->nullable();
            $table->string('order_currency_code')->nullable();
            $table->string('applied_cart_rule_ids')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
