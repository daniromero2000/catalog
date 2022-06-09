<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_request_stream_account_id')->unsigned()->index();
            $table->foreign('contract_request_stream_account_id')->references('id')->on('contract_request_stream_accounts')->onDelete('cascade');
            $table->decimal('usd_amount', 12, 2)->default(0)->unsigned();
            $table->decimal('commission', 12, 2)->default(0)->nullable()->unsigned();
            $table->decimal('real_commission', 12, 2)->unsigned()->default(0);
            $table->decimal('trm', 12, 2)->default(0)->nullable()->unsigned();
            $table->decimal('advances', 12, 2)->default(0)->nullable()->unsigned();
            $table->decimal('subtotal', 12, 2)->default(0)->nullable();
            $table->decimal('grand_total', 12, 2)->default(0)->nullable();
            $table->decimal('4x1000', 12, 2)->default(0)->nullable();
            $table->decimal('real_gain', 12, 2)->default(0)->nullable();
            $table->decimal('usd_gain', 12, 2)->default(0)->nullable();
            $table->integer('payment_request_status_id')->unsigned()->index()->default(1);
            $table->foreign('payment_request_status_id')->references('id')->on('payment_request_statuses')->onDelete('cascade');
            $table->tinyInteger('payment_type')->unsigned()->default(1);
            $table->integer('payment_cut_id')->nullable()->unsigned()->index();
            $table->foreign('payment_cut_id')->references('id')->on('payment_cuts')->onDelete('cascade');
            $table->integer('chase_transfer_id')->unsigned()->index()->nullable();
            $table->foreign('chase_transfer_id')->references('id')->on('chase_transfers');
            $table->integer('customer_bank_account_id')->nullable()->unsigned()->index();
            $table->foreign('customer_bank_account_id')->references('id')->on('customer_bank_accounts')->onDelete('cascade');
            $table->string('invoice')->nullable();
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
        Schema::dropIfExists('payment_requests');
    }
}
