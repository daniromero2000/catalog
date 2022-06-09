<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCammodelSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodel_social_media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profile');
            $table->string('user');
            $table->string('password');
            $table->integer('cammodel_id')->unsigned();
            $table->foreign('cammodel_id')->references('id')->on('cammodels')->onDelete('cascade');
            $table->integer('social_media_id')->unsigned();
            $table->foreign('social_media_id')->references('id')->on('social_media')->onDelete('cascade');
            $table->integer('corporate_phone_id')->unsigned()->index();
            $table->foreign('corporate_phone_id')->references('id')->on('corporate_phones')->onDelete('cascade');
            $table->tinyInteger('is_active')->unsigned()->default(1);
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
        Schema::dropIfExists('cammodel_social_media');
    }
}
