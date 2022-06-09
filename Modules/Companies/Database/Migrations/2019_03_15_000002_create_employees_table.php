<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique()->nullable()->default('Sin Email');
            $table->string('password')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('genre_id')->unsigned()->nullable();
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->string('avatar')->nullable();
            $table->string('signature')->nullable()->unique();
            $table->integer('subsidiary_id')->nullable()->unsigned();
            $table->foreign('subsidiary_id')->references('id')->on('subsidiaries');
            $table->integer('employee_position_id')->unsigned();
            $table->foreign('employee_position_id')->references('id')->on('employee_positions');
            $table->char('rh')->nullable()->default('No RH');
            $table->string('bank_account')->unique()->nullable();
            $table->integer('shift_id')->unsigned()->nullable();
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('set null');
            $table->date('admission_date')->nullable();
            $table->tinyInteger('is_rotative')->unsigned()->default(0);
            $table->integer('customer_id')->unsigned()->nullable();
            //$table->foreign('customer_id')->references('id')->on('customers');
            $table->dateTime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->tinyInteger('is_active')->unsigned()->default(1);
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
        Schema::dropIfExists('employees');
    }
}
