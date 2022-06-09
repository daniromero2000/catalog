<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCammodelFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodel_fines', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cammodel_id');
            $table->foreign('cammodel_id')->references('id')->on('cammodels')->onDelete('cascade');
            $table->foreignId('foul_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('cammodel_payroll_id')->nullable();
            $table->foreign('cammodel_payroll_id')->references('id')->on('cammodel_payrolls')->onDelete('cascade');
            $table->tinyInteger('is_aprobed')->unsigned()->default(0);
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
        Schema::dropIfExists('cammodel_fines');
    }
}
