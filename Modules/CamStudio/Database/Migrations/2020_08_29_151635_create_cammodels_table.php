<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCammodelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->integer('shift_id')->unsigned()->nullable();
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('set null');
            $table->tinyInteger('fake_age')->unsigned()->default(18);
            $table->string('cover')->nullable();
            $table->string('cover_page')->nullable();
            $table->string('nickname')->default('N/A');
            $table->string('slug')->default('N/A');
            $table->string('height')->default(0);
            $table->string('weight')->default(0);
            $table->string('breast_cup_size')->default(0);
            $table->string('image_tks')->nullable();
            $table->text('tattoos_piercings')->nullable();
            $table->text('meta')->nullable();
            $table->text('likes_dislikes')->nullable();
            $table->text('about_me')->nullable();
            $table->text('private_show')->nullable();
            $table->text('my_rules')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
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
        Schema::dropIfExists('cammodels');
    }
}
