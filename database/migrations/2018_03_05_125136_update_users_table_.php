<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->dropColumn('email');
            $table->dropRememberToken();
            $table->dropTimestamps();
            $table->string('password')->nullable()->change();
            $table->char('role', 5);
            $table->unsignedInteger('client_id')->nullable();
            $table->double('price_coefficient')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email');
            $table->rememberToken();
            $table->timestamps();
            $table->string('password')->change();
            $table->dropColumn('role');
            $table->dropColumn('client_id');
            $table->dropColumn('price_coefficient');
        });
    }
}
