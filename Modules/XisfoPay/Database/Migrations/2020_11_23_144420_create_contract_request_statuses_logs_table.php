<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractRequestStatusesLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_request_statuses_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_request_id')->unsigned()->index();
            $table->foreign('contract_request_id')->references('id')->on('contract_requests')->onDelete('cascade');
            $table->string('status');
            $table->string('user');
            $table->string('time_passed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract_request_statuses_logs');
    }
}
