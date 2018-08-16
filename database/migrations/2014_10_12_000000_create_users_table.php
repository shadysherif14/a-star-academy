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

            $table->string('first_name')->nullable();
            
            $table->string('last_name')->nullable();
            
            $table->string('email')->unique();
            
            $table->string('username');
            
            $table->string('avatar')->default('images/defaults/avatar.png');
            
            $table->enum('gender', ['Male', 'Female'])->nullable();
            
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
        Schema::dropIfExists('users');
    }
}
