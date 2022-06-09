<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCammodelImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodel_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cammodel_id')->unsigned()->nullable();
            $table->foreign('cammodel_id')->references('id')->on('cammodels')->onDelete('cascade');
            $table->string('src');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cammodel_images');
    }
}