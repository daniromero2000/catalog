<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cammodel_social_media_id');
            $table->foreign('cammodel_social_media_id')->references('id')->on('cammodel_social_media')->onDelete('cascade');
            $table->integer('followers_count');
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
        Schema::dropIfExists('social_stats');
    }
}
