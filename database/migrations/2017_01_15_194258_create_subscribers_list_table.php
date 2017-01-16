<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribersListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriber_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('listName')->unique();
            $table->integer('product_id')->nullable();
            $table->string('unique_id')->unique();
            $table->softDeletes();
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
        Schema::drop('subscriber_list', function(Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
