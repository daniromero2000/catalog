<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCammodelStreamingIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodel_streaming_incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cammodel_work_report_id')->nullable();
            $table->foreign('cammodel_work_report_id')->references('id')->on('cammodel_work_reports')->onDelete('cascade');
            $table->unsignedInteger('cammodel_stream_account_id');
            $table->foreign('cammodel_stream_account_id')->references('id')->on('cammodel_stream_accounts')->onDelete('cascade');
            $table->decimal('tokens', 12, 2)->default(0)->unsigned()->nullable();
            $table->decimal('dollars', 12, 2)->default(0)->unsigned()->nullable();
            $table->decimal('accumulated_tokens', 12, 2)->default(0)->unsigned()->nullable();
            $table->decimal('accumulated_dollars', 12, 2)->default(0)->unsigned()->nullable();
            $table->string('user_approves')->nullable();
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
        Schema::dropIfExists('cammodel_streaming_incomes');
    }
}
