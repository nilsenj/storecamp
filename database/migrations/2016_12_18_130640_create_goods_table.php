<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('goods', function(Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('good'); // good
            $table->integer('user_id');
            $table->string('title');
            $table->text('body');
            $table->string('slug')->nullable();
            $table->decimal('price', 8, 2);
            $table->integer('count');
            $table->boolean('availability')->default(true);
            $table->timestamp('published_at');
            $table->integer('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('goods', function(Blueprint $table) {
            $table->dropForeign('goods_category_id_foreign');
        });
	}

}
