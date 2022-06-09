<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePqrsStatusesLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pqrs_statuses_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pqr_id')->unsigned()->index();
            $table->foreign('pqr_id')->references('id')->on('pqrs')->onDelete('cascade');
            $table->string('status');
            $table->string('user');
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
        Schema::dropIfExists('pqrs_statuses_logs');
    }
}
