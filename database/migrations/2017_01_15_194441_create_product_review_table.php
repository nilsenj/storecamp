<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('product')->nullable();
            $table->string('unique_id')->unique();
            $table->boolean('visible')->default(false);
            $table->unsignedTinyInteger('rating')->default(5);
            $table->string('resolved')->default(false);
            $table->timestamp('date')->default(\Carbon\Carbon::today());
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_reviews', function(Blueprint $table) {
            $table->dropForeign('product_reviews_user_id_foreign');
            $table->dropSoftDeletes();
        });
    }
}
