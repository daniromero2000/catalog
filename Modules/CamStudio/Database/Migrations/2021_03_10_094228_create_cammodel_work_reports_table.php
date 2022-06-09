<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCammodelWorkReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodel_work_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cammodel_id');
            $table->foreign('cammodel_id')->references('id')->on('cammodels')->onDelete('cascade');
            $table->unsignedInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->unsignedInteger('subsidiary_id');
            $table->foreign('subsidiary_id')->references('id')->on('subsidiaries');
            $table->unsignedInteger('cammodel_shift_id');
            $table->foreign('cammodel_shift_id')->references('id')->on('shifts')->onDelete('cascade');
            $table->unsignedInteger('shift_id');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
            $table->unsignedInteger('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('employees')->onDelete('cascade');
            $table->time('entry_time')->nullable();
            $table->time('connection_time')->nullable();
            $table->time('disconnection_time')->nullable();
            $table->text('observations')->nullable();
            $table->unsignedBigInteger('cammodel_payroll_id')->nullable();
            $table->foreign('cammodel_payroll_id')->references('id')->on('cammodel_payrolls')->onDelete('cascade');
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
        Schema::dropIfExists('cammodel_work_reports');
    }
}
