<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('constitution_type')->nullable()->default('Natural');
            $table->string('company_legal_name')->nullable();
            $table->string('company_commercial_name')->nullable()->default('No Name');
            $table->string('company_address')->default('No Address');
            $table->string('neighborhood')->nullable()->default('No Data');
            $table->string('company_id_number')->nullable()->unique();
            $table->tinyInteger('prefix')->default(57)->nullable();
            $table->string('company_phone')->nullable()->default('No Phone');
            $table->integer('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('logo')->nullable()->default('No Logo');
            $table->string('file')->nullable();
            $table->integer('subsidiaries')->unsigned()->nullable()->default(1);
            $table->tinyInteger('is_active')->unsigned()->default(1);
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
        Schema::dropIfExists('customer_economic_activities');
    }
}
