<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommissionToContractRequestStreamAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract_request_stream_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('contract_request_stream_account_commission_id')->index('account_commission_id_index')->nullable()->after('nickname');
            $table->foreign('contract_request_stream_account_commission_id', 'account_commission_id_foreign')->references('id')->on('contract_request_stream_account_commissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract_request_stream_accounts', function (Blueprint $table) {
            //
        });
    }
}
