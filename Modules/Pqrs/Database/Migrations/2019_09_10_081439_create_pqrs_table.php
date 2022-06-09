<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePqrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pqrs', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('cedula');
            $table->string('name');
            $table->string('email');
            $table->string('lead')->nullable();
            $table->string('phone')->nullable();
            $table->string('pqr');
            $table->string('asunto');
            $table->string('mensaje');
            $table->integer('pqr_status_id')->unsigned();
            $table->foreign('pqr_status_id')->references('id')->on('pqr_statuses');
            $table->unsignedInteger('city_id')->index();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->boolean('data_politics')->nullable();
            $table->tinyInteger('lapsed')->unsigned()->default(0);
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('pqrs');
    }
}
