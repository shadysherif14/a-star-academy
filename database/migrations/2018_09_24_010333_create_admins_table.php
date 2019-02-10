<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name');

            $table->string('email')->unique()->nullable();

            $table->string('username')->unique()->nullable();

            $table->string('avatar')->default('images/defaults/avatar.png');

            $table->string('password');

            $table->rememberToken();

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
        Schema::drop('admins');
    }
}
