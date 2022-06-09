<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_identifier')->unique();
            $table->integer('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('contract_id')->unsigned()->nullable()->index();
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            $table->bigInteger('customer_company_id')->unsigned()->nullable()->index()->default(1);
            $table->foreign('customer_company_id')->references('id')->on('customer_companies')->onDelete('cascade');
            $table->tinyInteger('contract_request_type');
            $table->integer('contract_request_status_id')->unsigned()->nullable()->index()->default(7);
            $table->foreign('contract_request_status_id')->references('id')->on('contract_request_statuses')->onDelete('cascade');
            $table->string('file')->nullable()->unique();
            $table->integer('employee_id')->unsigned()->nullable()->index();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->tinyInteger('physical_file')->unsigned()->default(0);
            $table->tinyInteger('is_active')->unsigned()->default(1);
            $table->tinyInteger('is_signed')->unsigned()->default(0);
            $table->tinyInteger('finantial_retention')->unsigned()->default(0);
            $table->tinyInteger('is_bank_processing_commission_free')->unsigned()->default(0);
            $table->tinyInteger('is_aprobed')->unsigned()->default(0);
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
        Schema::dropIfExists('contract_requests');
    }
}
