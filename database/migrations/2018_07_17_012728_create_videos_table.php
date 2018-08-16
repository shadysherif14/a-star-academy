<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {

            $table->increments('id');
            
            $table->unsignedInteger('course_id');
            
            $table->string('path');

            $table->string('title');
            
            $table->string('description');

            $table->string('slug');
            
            // store json string as
            // {hours:1, minuts:1, seconds:1}
            $table->string('duration');


            $table->boolean('free')->default(false);

            $table->unsignedInteger('order');
    
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
        Schema::dropIfExists('videos');
    }
}
