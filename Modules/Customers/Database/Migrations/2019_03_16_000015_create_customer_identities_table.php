<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerIdentitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_identities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('identity_type_id')->unsigned()->index()->default(1);
            $table->foreign('identity_type_id')->references('id')->on('identity_types');
            $table->string('identity_number');
            $table->date('expedition_date');
            $table->integer('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->integer('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('file')->nullable();
            $table->tinyInteger('is_active')->unsigned()->default(1);
            $table->tinyInteger('is_aprobed')->unsigned()->default(0);
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
        Schema::dropIfExists('customer_identities');
    }
}
