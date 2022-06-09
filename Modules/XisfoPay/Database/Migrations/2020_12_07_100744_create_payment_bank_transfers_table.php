<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentBankTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_bank_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_request_id')->unsigned()->nullable()->index();
            $table->foreign('payment_request_id')->references('id')->on('payment_requests')->onDelete('cascade');
            $table->unsignedInteger('payment_request_advance_id')->nullable();
            $table->foreign('payment_request_advance_id')->references('id')->on('payment_request_advances');
            $table->decimal('value', 12, 2)->default(0)->nullable()->unsigned();
            $table->tinyInteger('is_transfered')->unsigned()->default(0);
            $table->tinyInteger('is_aprobed')->unsigned()->default(1);
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
        Schema::dropIfExists('payment_bank_transfers');
    }
}
