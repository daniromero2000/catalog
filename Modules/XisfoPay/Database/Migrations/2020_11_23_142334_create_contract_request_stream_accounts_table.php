<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractRequestStreamAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_request_stream_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_request_id')->unsigned()->index();
            $table->foreign('contract_request_id')->references('id')->on('contract_requests')->onDelete('cascade');
            $table->integer('streaming_id')->unsigned()->index();
            $table->foreign('streaming_id')->references('id')->on('streamings')->onDelete('cascade');
            $table->string('nickname');
            $table->unsignedBigInteger('contract_request_stream_account_commission_id')->index('account_commission_id_index')->nullable();
            $table->foreign('contract_request_stream_account_commission_id', 'account_commission_id_foreign')->references('id')->on('contract_request_stream_account_commissions');
            $table->tinyInteger('set_up')->unsigned()->default(0);
            $table->tinyInteger('is_active')->unsigned()->default(0);
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
        Schema::dropIfExists('contract_request_stream_accounts');
    }
}
