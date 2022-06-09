<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamstudioReportCommentariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camstudio_report_commentaries', function (Blueprint $table) {
            $table->id();
            $table->text('commentary');
            $table->string('user');
            $table->string('period_type');
            $table->unsignedInteger('subsidiary_id')->nullable();
            $table->foreign('subsidiary_id')->references('id')->on('subsidiaries');
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
        Schema::dropIfExists('camstudio_report_commentaries');
    }
}
