<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('housing_id')->unsigned()->index()->default(4);
            $table->foreign('housing_id')->references('id')->on('housings')->default(4);
            $table->string('customer_address');
            $table->string('neighborhood')->nullable()->default('No Data');
            $table->integer('time_living')->unsigned()->default(0);
            $table->integer('stratum_id')->unsigned()->index()->default(1);
            $table->foreign('stratum_id')->references('id')->on('stratums');
            $table->integer('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->integer('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('postal_code')->nullable();
            $table->text('comment')->nullable();
            $table->tinyInteger('default_address')->unsigned()->default(1);
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
        Schema::dropIfExists('customer_addresses');
    }
}
