<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial', 20)->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('cropped_avatar')->nullable();
            $table->unsignedInteger('level_id')->nullable();
            $table->text('accounts')->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->boolean('blocked')->default(false);
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
        Schema::dropIfExists('users');
    }
}
