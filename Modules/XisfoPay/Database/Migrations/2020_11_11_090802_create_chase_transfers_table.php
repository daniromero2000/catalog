<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaseTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chase_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('chase_transfer_trm_id');
            $table->foreign('chase_transfer_trm_id')->references('id')->on('chase_transfer_trms');
            $table->decimal('transfer_amount', 12, 2)->unsigned()->default(0);
            $table->decimal('commission', 12, 2)->unsigned()->default(0);
            $table->string('user_approves')->nullable();
            $table->tinyInteger('is_approved')->unsigned()->default(0);
            $table->unsignedBigInteger('bank_movement_id');
            $table->foreign('bank_movement_id')->references('id')->on('bank_movements');
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
        Schema::dropIfExists('chase_transfers');
    }
}
