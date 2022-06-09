<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCammodelCammodelTipperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodel_cammodel_tipper', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('cammodel_tipper_id');
            $table->foreign('cammodel_tipper_id')->references('id')->on('cammodel_tippers');
            $table->unsignedInteger('cammodel_id');
            $table->foreign('cammodel_id')->references('id')->on('cammodels');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cammodel_cammodel_tipper');
    }
}