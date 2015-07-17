<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('user_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->unsigned();
            $table->integer('rid')->unsigned();
            $table->foreign('pid')->references('pid')->on('permissions');
            $table->foreign('rid')->references('rid')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_permissions');
    }
}
