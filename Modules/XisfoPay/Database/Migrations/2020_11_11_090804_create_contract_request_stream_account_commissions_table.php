<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractRequestStreamAccountCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_request_stream_account_commissions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 12, 2)->unsigned()->default(0);
            $table->unsignedInteger('streaming_id');
            $table->foreign('streaming_id')->references('id')->on('streamings');
            $table->tinyInteger('is_default')->default('0');
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
        Schema::dropIfExists('contract_request_stream_account_commissions');
    }
}
