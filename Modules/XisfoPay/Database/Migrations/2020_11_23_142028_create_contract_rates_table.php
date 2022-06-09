<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('percentage')->unique();
            $table->tinyInteger('type')->nullable()->default(0);
            $table->decimal('value', 12, 2)->unique()->default(0)->unsigned();
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
        Schema::dropIfExists('contract_rates');
    }
}
