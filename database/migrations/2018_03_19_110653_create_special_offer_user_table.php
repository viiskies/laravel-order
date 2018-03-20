<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialOfferUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_offer_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('special_offer_id');
            $table->unsignedInteger('user_id');
            $table->foreign('special_offer_id')->references('id')->on('special_offers');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_offer_user');
    }
}
