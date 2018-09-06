<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

            $table->float('price');

            $table->string('description')->nullable();

            $table->string('slug');

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
