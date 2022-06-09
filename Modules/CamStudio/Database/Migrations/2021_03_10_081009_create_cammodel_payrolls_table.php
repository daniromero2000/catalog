<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCammodelPayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodel_payrolls', function (Blueprint $table) {
            $table->id();
            $table->integer('cammodel_id')->unsigned()->index();
            $table->foreign('cammodel_id')->references('id')->on('cammodels')->onDelete('cascade');
            $table->decimal('usd_cammodel', 12, 2)->nullable()->unsigned()->default(0);
            $table->decimal('bonus', 12, 2)->nullable()->unsigned()->default(0);
            $table->decimal('total_usd_cammodel', 12, 2)->nullable()->unsigned()->default(0);
            $table->decimal('usd_studio', 12, 2)->nullable()->unsigned()->default(0);
            $table->decimal('total_cop_cammodel', 12, 2)->nullable()->unsigned()->default(0);
            $table->decimal('trm', 12, 2)->nullable()->unsigned()->default(0);
            $table->string('user_approves')->nullable();
            $table->timestamp('from');
            $table->timestamp('to');
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
        Schema::dropIfExists('cammodel_payrolls');
    }
}
