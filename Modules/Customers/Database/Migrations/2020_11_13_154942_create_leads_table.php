<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('data_politics')->nullable()->default(1);
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->integer('customer_channel_id')->unsigned()->nullable()->default(11);
            $table->foreign('customer_channel_id')->references('id')->on('customer_channels')->onDelete('set null');
            $table->integer('lead_status_id')->unsigned()->default(3);
            $table->foreign('lead_status_id')->references('id')->on('lead_statuses');
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->integer('subsidiary_id')->unsigned()->nullable();
            $table->foreign('subsidiary_id')->references('id')->on('subsidiaries')->onDelete('set null');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services');
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
        Schema::dropIfExists('leads');
    }
}
