<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewCommentariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_commentaries', function (Blueprint $table) {
            $table->increments('id');
            $table->text('commentary');
            $table->string('user');
            $table->boolean('customer_notified')->default(0);
            $table->integer('interview_id')->unsigned()->index();
            $table->foreign('interview_id')->references('id')->on('interviews')->onDelete('cascade');
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
        Schema::dropIfExists('interview_commentaries');
    }
}
