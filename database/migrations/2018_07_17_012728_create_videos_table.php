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
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('title');
            $table->unsignedInteger('order');
            $table->boolean('overview')->default(false);
            $table->integer('one_price')->default(0);
            $table->integer('max_price')->default(0);
            $table->integer('max_times')->default(0);                     
            $table->string('slug');
            $table->string('duration');
            $table->text('description')->nullable();
            $table->string('poster')->nullable();
            $table->string('path');
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
