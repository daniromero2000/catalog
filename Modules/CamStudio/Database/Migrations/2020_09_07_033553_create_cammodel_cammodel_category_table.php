<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCammodelCammodelCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodel_cammodel_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cammodel_category_id')->unsigned()->index();
            $table->foreign('cammodel_category_id')->references('id')->on('cammodel_categories');
            $table->integer('cammodel_id')->unsigned()->index();
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
        Schema::dropIfExists('cammodel_cammodel_category');
    }
}