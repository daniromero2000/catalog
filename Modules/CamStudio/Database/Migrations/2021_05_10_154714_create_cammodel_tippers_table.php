<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCammodelTippersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodel_tippers', function (Blueprint $table) {
            $table->id();
            $table->string('profile');
            $table->string('nickname')->nullable()->default('--No Data--');
            $table->unsignedInteger('streaming_id');
            $table->foreign('streaming_id')->references('id')->on('streamings');
            $table->date('birthday')->nullable();
            $table->string('location')->nullable()->default('--No Data--');
            $table->text('pleasures')->nullable();
            $table->string('rate')->nullable();
            $table->text('observations')->nullable();
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
        Schema::dropIfExists('cammodel_tippers');
    }
}
