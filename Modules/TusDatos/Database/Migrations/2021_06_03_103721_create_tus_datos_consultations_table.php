<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTusDatosConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tus_datos_consultations', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('identiy_number')->nullable();
            $table->string('jobid')->nullable();
            $table->string('name')->nullable();
            $table->string('typedoc')->nullable();
            $table->boolean('validado')->nullable();
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
        Schema::dropIfExists('tus_datos_consultations');
    }
}
