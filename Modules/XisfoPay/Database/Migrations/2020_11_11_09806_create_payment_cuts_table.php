<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentCutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_cuts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chase_transfer_trm_id')->unsigned()->nullable();
            $table->foreign('chase_transfer_trm_id')->references('id')->on('chase_transfer_trms');
            $table->decimal('chase_transfer_trm', 12, 2)->default(0)->nullable()->unsigned();
            $table->string('payment_cut_bank');
            $table->string('user_approves')->nullable();
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
        Schema::dropIfExists('payment_cuts');
    }
}
