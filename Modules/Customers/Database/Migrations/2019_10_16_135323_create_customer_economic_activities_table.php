<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerEconomicActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_economic_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->integer('economic_activity_type_id')->unsigned()->nullable();
            $table->foreign('economic_activity_type_id')->references('id')->on('economic_activity_types');
            $table->string('entity_legal_name')->default('No Name');
            $table->string('entity_commercial_name')->nullable()->default('No Name');
            $table->integer('professions_list_id')->unsigned()->nullable();
            $table->foreign('professions_list_id')->references('id')->on('professions_lists');
            $table->date('start_date')->nullable();
            $table->integer('incomes')->unsigned()->default(0);
            $table->integer('other_incomes')->unsigned()->default(0);
            $table->string('other_incomes_source')->nullable()->default('None');
            $table->integer('expenses')->unsigned()->default(0);
            $table->string('entity_address')->default('No Address');
            $table->string('neighborhood')->nullable()->default('No Data');
            $table->tinyInteger('prefix')->default(57)->nullable();
            $table->string('entity_phone')->default('No Phone');
            $table->integer('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('logo')->nullable()->default('No Logo');
            $table->integer('subsidiaries')->unsigned()->nullable()->default(0);
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
        Schema::dropIfExists('customer_economic_activities');
    }
}
