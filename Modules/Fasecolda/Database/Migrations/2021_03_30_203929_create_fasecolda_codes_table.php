<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFasecoldaCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasecolda_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Novedad')->nullable();
            $table->string('Marca')->nullable();
            $table->string('Clase')->nullable();
            $table->string('Codigo');
            $table->string('Homologocodigo')->nullable();
            $table->string('Referencia1')->nullable();
            $table->string('Referencia2')->nullable();
            $table->string('Referencia3')->nullable();
            $table->integer('Peso')->nullable()->unsigned()->default(1);
            $table->tinyInteger('IdServicio')->nullable()->unsigned()->default(0);
            $table->string('Servicio')->nullable();
            $table->integer('Bcpp')->nullable()->unsigned()->default(1);
            $table->tinyInteger('Importado')->nullable()->unsigned()->default(0);
            $table->integer('Potencia')->nullable()->unsigned()->default(1);
            $table->string('TipoCaja')->nullable();
            $table->integer('Cilindraje')->nullable()->unsigned()->default(1);
            $table->string('Nacionalidad')->nullable();
            $table->tinyInteger('CapacidadPasajeros')->nullable()->unsigned()->default(1);
            $table->integer('CapacidadCarga')->nullable()->unsigned()->default(1);
            $table->tinyInteger('Puertas')->nullable()->unsigned()->default(1);
            $table->tinyInteger('AireAcondicionado')->nullable()->unsigned()->default(0);
            $table->tinyInteger('Ejes')->nullable()->unsigned()->default(1);
            $table->string('Estado')->nullable();
            $table->string('Combustible')->nullable();
            $table->string('Transmision')->nullable();
            $table->tinyInteger('Um')->nullable()->unsigned()->default(1);
            $table->tinyInteger('PesoCategoria')->nullable()->unsigned()->default(1);
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
        Schema::dropIfExists('fasecolda_codes');
    }
}
