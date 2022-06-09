<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('sku')->nullable();
            $table->integer('qty')->unsigned()->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('base_price', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->decimal('base_total', 12, 2)->default(0);
            $table->decimal('tax_amount', 12, 2)->default(0)->nullable();
            $table->decimal('base_tax_amount', 12, 2)->default(0)->nullable();
            $table->integer('invoice_id')->unsigned()->nullable();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('invoice_items')->onDelete('cascade');
            $table->decimal('discount_percent', 12, 2)->default(0)->nullable();
            $table->decimal('discount_amount', 12, 2)->default(0)->nullable();
            $table->decimal('base_discount_amount', 12, 2)->default(0)->nullable();
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
        Schema::dropIfExists('invoice_items');
    }
}
