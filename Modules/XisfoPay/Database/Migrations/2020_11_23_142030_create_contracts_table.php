<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_status_id')->unsigned()->nullable()->index()->default(1);
            $table->foreign('contract_status_id')->references('id')->on('contract_statuses')->onDelete('cascade');
            $table->tinyInteger('physical_file')->unsigned()->default(0);
            $table->tinyInteger('is_active')->unsigned()->default(0);
            $table->tinyInteger('is_signed')->unsigned()->default(0);
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
        Schema::dropIfExists('contracts');
    }
}
