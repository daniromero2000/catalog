<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentRequestImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_request_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_request_id')->unsigned()->nullable();
            $table->foreign('payment_request_id')->references('id')->on('payment_requests')->onDelete('cascade');
            $table->string('src');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_request_images');
    }
}
