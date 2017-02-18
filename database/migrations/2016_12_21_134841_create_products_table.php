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

            $table->string('unique_id')->unique();
            $table->string('title');
            $table->text('body');
            $table->char('model')->nullable();
            $table->string('slug')->nullable();
            $table->string('stock_status')->nullable();
            $table->integer('viewed')->default(0);
            $table->integer('quantity')->default(0);
            $table->decimal('tax', 20, 2)->default(0);
            $table->decimal('shipping', 20, 2)->default(0);
            $table->string('currency')->nullable();
            $table->string('class')->nullable();
            $table->string('reference_id')->nullable();
            $table->char('sku', 64)->nullable();
            $table->char('upc', 12)->nullable();
            $table->char('ean', 14)->nullable();
            $table->char('jan', 13)->nullable();
            $table->char('isbn', 17)->nullable();
            $table->char('mpn', 64)->nullable();
            $table->decimal('price', 20, 2)->default(null);
            $table->decimal('length', 15, 8)->default(0.00000000);
            $table->decimal('width', 15, 8)->default(0.00000000);
            $table->decimal('height', 15, 8)->default(0.00000000);
            $table->decimal('weight', 15, 4)->default(0.0000);
            $table->timestamp('date_available');
            $table->boolean('availability')->default(true);
            $table->string('meta_tag_title')->nullable();
            $table->text('meta_tag_description')->nullable();
            $table->text('meta_tag_keywords')->nullable();
            $table->tinyInteger('sort_order')->default(0);
            $table->integer('user_id')->unsigned();
            $table->bigInteger('cart_id')->unsigned()->nullable();
            $table->bigInteger('order_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('cart_id')
                ->references('id')
                ->on('cart')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(['sku', 'cart_id']);
            $table->unique(['sku', 'order_id']);
            $table->index(['user_id', 'sku']);
            $table->index(['user_id', 'sku', 'cart_id']);
            $table->index(['user_id', 'sku', 'order_id']);
            $table->index(['reference_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
