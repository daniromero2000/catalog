<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->integer('bank_id')->unsigned()->nullable()->default(1);
            //$table->foreign('bank_id')->references('id')->on('banks');
            $table->string('account_type')->default('No Data');
            $table->string('account_number')->default('No Data');
            $table->string('account_certificate')->nullable();
            $table->integer('customer_identity_id')->nullable()->unsigned()->index();
            $table->foreign('customer_identity_id')->references('id')->on('customer_identities')->onDelete('cascade');
            $table->tinyInteger('is_default')->unsigned()->default(1);
            $table->tinyInteger('is_active')->unsigned()->default(1);
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
        Schema::dropIfExists('customer_bank_accounts');
    }
}
