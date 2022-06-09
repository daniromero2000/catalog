<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShiftIdToEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /**Schema::table('employees', function (Blueprint $table) {
            $table->integer('shift_id')->unsigned()->nullable()->after('work_schedule');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('set null');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
}
