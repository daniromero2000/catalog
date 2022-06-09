<?php

use Kalnoy\Nestedset\NestedSet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCammodelCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cammodel_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('cover')->nullable()->default('Sin Banner');
            $table->string('banner')->default('Sin Banner');
            $table->boolean('is_visible_on_front')->default(0);
            $table->unsignedInteger('sort_order')->default(0);
            $table->tinyInteger('is_active')->unsigned()->default(1);
            NestedSet::columns($table);
            $table->integer('depth')->default('0');
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
        Schema::table('cammodel_categories', function (Blueprint $table) {

            $sm = Schema::getConnection()->getDoctrineSchemaManager();

            $doctrineTable = $sm->listTableDetails('cammodel_categories');

            if ($doctrineTable->hasIndex('cammodel_categories__lft__rgt_parent_id_index')) {
                $table->dropIndex('cammodel_categories__lft__rgt_parent_id_index');
            }
        });

        Schema::dropIfExists('cammodel_categories');
    }
}
