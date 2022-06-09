<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamingStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streaming_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cammodel_stream_account_id');
            $table->foreign('cammodel_stream_account_id')->references('id')->on('cammodel_stream_accounts')->onDelete('cascade');
            $table->integer('time_online')->nullable();
            $table->integer('tips_in_last_hour')->nullable();
            $table->integer('num_followers')->nullable();
            $table->integer('token_balance->nullable()');
            $table->integer('satisfaction_score')->nullable();
            $table->integer('num_tokened_viewers')->nullable();
            $table->integer('votes_down')->nullable();
            $table->integer('votes_up')->nullable();
            $table->timestamp('last_broadcast')->nullable();
            $table->integer('num_registered_viewers')->nullable();
            $table->integer('num_viewers')->nullable();
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
        Schema::dropIfExists('streaming_stats');
    }
}
