<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_video', function (Blueprint $table) {

            $table->increments('id');

            $table->unsignedInteger('user_id');

            $table->unsignedInteger('video_id');

            $table->unsignedInteger('price');

            $table->string('paymob_id')->nullable();

            $table->unsignedInteger('watched_times')->default(0);

            $table->unsignedInteger('max_watching_times')->nullable()->default(1);

            $table->datetime('subscription_end_data')->nullable();

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
        Schema::dropIfExists('user_video');
    }
}
