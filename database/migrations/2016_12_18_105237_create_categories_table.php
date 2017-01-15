<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id')->unique();
            $table->integer('parent_id')->unsigned()->nullable();

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image_link')->nullable();
            $table->string('slug')->nullable();
            $table->string('meta_tag_title')->nullable();
            $table->text('meta_tag_description')->nullable();
            $table->text('meta_tag_keywords')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('top')->default(false);
            $table->tinyInteger('sort_order')->default(0);

            $table->timestamps();
            $table->index('parent_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories', function(Blueprint $t) {
            $t->dropIndex('categories_parent_id_index');
        });
    }
}
