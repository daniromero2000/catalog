<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCammodelWorkReportCommentariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodel_work_report_commentaries', function (Blueprint $table) {
            $table->id();
            $table->text('commentary');
            $table->string('user');
            $table->unsignedBigInteger('cammodel_work_report_id');
            $table->foreign('cammodel_work_report_id', 'cwr_id_foreign')->references('id')->on('cammodel_work_reports');
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
        Schema::dropIfExists('cammodel_work_report_commentaries');
    }
}
