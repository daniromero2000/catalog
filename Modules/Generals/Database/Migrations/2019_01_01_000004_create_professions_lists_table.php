<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionsListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professions_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ciuo')->unsigned();
            $table->foreign('ciuo')->references('ciuo')->on('professions_groups');
            $table->string('profession')->unique();
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
        Schema::dropIfExists('professions_lists');
    }
}
