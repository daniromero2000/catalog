<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('identification_number')->default('No ID');
            $table->date('birthday');
            $table->string('phone')->default('No Phone');
            $table->string('email')->default('No Email');
            $table->string('address')->nullable()->default('No Address');
            $table->tinyInteger('calification')->nullable()->default(0);
            $table->integer('employee_position_id')->unsigned();
            $table->foreign('employee_position_id')->references('id')->on('employee_positions');
            $table->tinyInteger('english_knowledge')->nullable()->default(0);
            $table->integer('interview_status_id')->unsigned()->index()->default(4);
            $table->foreign('interview_status_id')->references('id')->on('interview_statuses');
            $table->string('picture')->nullable()->default('No Photo');
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
        Schema::dropIfExists('interviews');
    }
}
