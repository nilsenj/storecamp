<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_categories', function(Blueprint $t) {
            $t->integer('product_id');
            $t->integer('category_id');
            $t->primary(['product_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products_categories', function(Blueprint $t) {
            $t->dropPrimary('products_categories_product_id_primary');
            $t->dropPrimary('products_categories_category_id_primary');
        });
    }
}
