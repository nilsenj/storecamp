<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_list', function (Blueprint $table) {
            $table->integer('subscriber_id')->unsigned();
            $table->integer('subscriber_list_id')->unsigned();
            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('subscriber_list_id')->references('id')->on('subscriber_list')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->primary(['subscriber_id', 'subscriber_list_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news_list', function(Blueprint $table) {
            $table->dropForeign('news_list_subscriber_id_foreign');
            $table->dropForeign('news_list_subscriber_list_id_foreign');
        });
    }
}
