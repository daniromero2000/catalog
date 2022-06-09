<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCammodelTipperSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodel_tipper_social_media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profile');
            $table->unsignedBigInteger('cammodel_tipper_id');
            $table->foreign('cammodel_tipper_id')->references('id')->on('cammodel_tippers');
            $table->integer('social_media_id')->unsigned();
            $table->foreign('social_media_id')->references('id')->on('social_media');
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
        Schema::dropIfExists('cammodel_tipper_social_media');
    }
}
