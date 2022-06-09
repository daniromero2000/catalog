<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->index();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->integer('brand_id')->unsigned()->nullable()->index();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->string('sku')->unique();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('cover')->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('price', 12, 2)->default(0)->nullable();
            $table->decimal('base_price', 12, 2)->default(0)->nullable();
            $table->decimal('sale_price', 12, 2)->default(0)->nullable();
            $table->boolean('special_price', 12, 2)->default(0)->nullable();
            $table->date('special_price_from')->nullable();
            $table->date('special_price_to')->nullable();
            $table->decimal('length')->default(0)->nullable();
            $table->decimal('width')->default(0)->nullable();
            $table->decimal('height')->default(0)->nullable();
            $table->string('distance_unit')->nullable();
            $table->decimal('weight')->default(0)->nullable();
            $table->string('mass_unit')->nullable();
            $table->integer('tax_id')->unsigned()->index();
            $table->foreign('tax_id')->references('id')->on('taxes');
            $table->boolean('is_visible_on_front')->default(0);
            $table->unsignedInteger('sort_order')->default(0);
            $table->tinyInteger('is_active')->unsigned()->default(1);
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
        Schema::dropIfExists('products');
    }
}
