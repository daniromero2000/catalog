<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractRenewalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_renewals', function (Blueprint $table) {
            $table->increments('id');
            $table->date('starts');
            $table->date('expires');
            $table->string('file')->nullable();
            $table->integer('contract_id')->unsigned()->index();
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
            $table->integer('contract_rate_id')->unsigned()->index()->default(1);
            $table->foreign('contract_rate_id')->references('id')->on('contract_rates')->onDelete('cascade');
            $table->tinyInteger('is_special_price')->unsigned()->default(0);
            $table->tinyInteger('is_active')->unsigned()->default(1);
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
        Schema::dropIfExists('contract_renewals');
    }
}
