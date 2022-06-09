<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentRequestAdvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_request_advances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_request_id')->unsigned()->nullable()->index();
            $table->foreign('payment_request_id')->references('id')->on('payment_requests')->onDelete('cascade');
            $table->decimal('value', 12, 2)->default(0)->nullable()->unsigned();
            $table->decimal('trm_tokens', 12, 2)->default(0)->nullable()->unsigned();
            $table->integer('payment_request_status_id')->unsigned()->nullable()->index()->default(1);
            $table->foreign('payment_request_status_id')->references('id')->on('payment_request_statuses')->onDelete('cascade');
            $table->tinyInteger('is_aprobed')->unsigned()->default(0);
            $table->tinyInteger('transfer')->unsigned()->default(0);
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
        Schema::dropIfExists('payment_request_advances');
    }
}
