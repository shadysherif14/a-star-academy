<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('level_id');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->unsignedInteger('instructor_id');
            $table->foreign('instructor')->references('id')->on('instructors')->onDelete('cascade');
            $table->string('name');
            $table->float('price')->default(0);
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('school');
            $table->enum('system', ['Cambridge', 'Edexcel'])->nullable();
            $table->enum('sub_system', ['A2', 'AS', 'AL', 'OL'])->nullable();
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
        Schema::dropIfExists('courses');
    }
}
