<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCammodelStreamAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodel_stream_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cammodel_id')->unsigned()->index();
            $table->foreign('cammodel_id')->references('id')->on('cammodels')->onDelete('cascade');
            $table->integer('streaming_id')->unsigned()->index();
            $table->foreign('streaming_id')->references('id')->on('streamings')->onDelete('cascade');
            $table->integer('corporate_phone_id')->unsigned()->index();
            $table->foreign('corporate_phone_id')->references('id')->on('corporate_phones')->onDelete('cascade');
            $table->string('profile');
            $table->string('user');
            $table->string('password');
            $table->text('embed_link')->nullable();
            $table->string('account_api_token')->nullable();
            $table->tinyInteger('set_up')->unsigned()->default(0);
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
        Schema::dropIfExists('cammodel_stream_accounts');
    }
}
