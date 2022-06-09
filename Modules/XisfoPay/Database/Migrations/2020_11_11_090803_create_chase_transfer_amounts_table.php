<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaseTransferAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chase_transfer_amounts', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 12, 2)->unsigned()->default(0);
            $table->unsignedBigInteger('chase_transfer_id');
            $table->foreign('chase_transfer_id')->references('id')->on('chase_transfers');
            $table->unsignedInteger('streaming_id');
            $table->foreign('streaming_id')->references('id')->on('streamings');
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
        Schema::dropIfExists('chase_transfer_amounts');
    }
}
