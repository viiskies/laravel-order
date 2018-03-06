<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock', function(Blueprint $table)
        {
           $table->foreign('product_id')->references('id')->on('products');
        });
        Schema::table('prices', function(Blueprint $table)
        {
            $table->foreign('product_id')->references('id')->on('products');
        });
        Schema::table('images', function(Blueprint $table)
        {
            $table->foreign('product_id')->references('id')->on('products');
        });
        Schema::table('category_product', function(Blueprint $table)
        {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('category_id')->references('id')->on('categories');
        });
        Schema::table('products', function(Blueprint $table)
        {
            $table->foreign('publisher_id')->references('id')->on('publishers');
            $table->foreign('platform_id')->references('id')->on('platforms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function(Blueprint $table)
        {
            $table->dropForeign(['platform_id']);
            $table->dropForeign(['publisher_id']);
        });
        Schema::table('category_product', function(Blueprint $table)
        {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['product_id']);
        });
        Schema::table('images', function(Blueprint $table)
        {
            $table->dropForeign(['product_id']);
        });
        Schema::table('prices', function(Blueprint $table)
        {
            $table->dropForeign(['product_id']);
        });
        Schema::table('stock', function(Blueprint $table)
        {
            $table->dropForeign(['product_id']);
        });
    }
}
