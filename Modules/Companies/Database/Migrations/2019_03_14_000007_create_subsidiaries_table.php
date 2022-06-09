<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubsidiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsidiaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address')->nullable()->default('No Address');
            $table->string('phone')->nullable()->default('No Phone');
            $table->string('opening_hours')->nullable();
            $table->unsignedInteger('city_id')->index();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedInteger('company_id')->index();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->tinyInteger('is_main')->unsigned()->default(0);
            $table->tinyInteger('is_active')->unsigned()->default(1);
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
        Schema::drop('subsidiaries');
    }
}
