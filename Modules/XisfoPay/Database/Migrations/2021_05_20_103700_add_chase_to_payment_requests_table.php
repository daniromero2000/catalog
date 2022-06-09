<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChaseToPaymentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('chase_transfer_id')->index()->nullable()->after('payment_cut_id');
            $table->foreign('chase_transfer_id')->references('id')->on('chase_transfers');
            $table->decimal('real_commission', 12, 2)->unsigned()->default(0)->after('commission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_requests', function (Blueprint $table) {
            //
        });
    }
}
