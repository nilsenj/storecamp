<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->char('model')->nullable();
            $table->string('slug')->nullable();
            $table->decimal('price', 8, 2);
            $table->integer('count');
            $table->integer('viewed')->default(0);
            $table->integer('quantity')->default(0);
            $table->char('sku', 64)->default(null);
            $table->char('upc', 12)->default(null);
            $table->char('ean', 14)->default(null);
            $table->char('jan', 13)->default(null);
            $table->char('isbn', 17)->default(null);
            $table->char('mpn', 64)->default(null);
            $table->decimal('price', 15, 4)->default(null);
            $table->decimal('length', 15, 8)->default(0.00000000);
            $table->decimal('width', 15, 8)->default(0.00000000);
            $table->decimal('height', 15, 8)->default(0.00000000);
            $table->timestamp('date_available');
            $table->boolean('availability')->default(true);
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
        Schema::drop('products', function(Blueprint $table) {
            $table->dropForeign('goods_category_id_foreign');
        });
    }
}
