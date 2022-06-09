<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streamings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('streaming')->unique();
            $table->string('initials')->nullable();
            $table->string('url')->nullable()->default('No URL');
            $table->integer('type')->default(1);
            $table->string('icon')->nullable()->default('No Icon');
            $table->decimal('usd_commission', 12, 2)->default(0)->nullable();
            $table->decimal('usd_token_rate', 12, 3)->unsigned()->nullable()->default(0);
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
        Schema::dropIfExists('streamings');
    }
}
