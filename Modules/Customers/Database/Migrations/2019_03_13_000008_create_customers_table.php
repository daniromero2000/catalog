<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_group_id')->unsigned()->default(2);
            $table->foreign('customer_group_id')->references('id')->on('customer_groups');
            $table->string('name');
            $table->string('last_name');
            $table->date('birthday')->nullable();
            $table->integer('birth_place_id')->unsigned()->default(1)->nullable();
            $table->foreign('birth_place_id')->references('id')->on('cities');
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->integer('scholarity_id')->unsigned()->default(4);
            $table->foreign('scholarity_id')->references('id')->on('scholarities');
            $table->string('email')->nullable()->default('No Email');
            $table->string('password')->nullable();
            $table->integer('customer_channel_id')->unsigned()->nullable()->default(10);
            $table->foreign('customer_channel_id')->references('id')->on('customer_channels')->onDelete('set null');
            $table->integer('civil_status_id')->unsigned()->default(6);
            $table->foreign('civil_status_id')->references('id')->on('civil_statuses');
            $table->integer('genre_id')->unsigned()->nullable()->default(3);
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('set null');
            $table->integer('customer_status_id')->unsigned()->default(3);
            $table->foreign('customer_status_id')->references('id')->on('customer_statuses');
            $table->boolean('data_politics')->nullable()->default(1);
            $table->boolean('is_verified')->default(0);
            $table->boolean('subscribed_to_news_letter')->default(0);
            $table->string('avatar')->nullable()->default('No Avatar');
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('customers');
    }
}
