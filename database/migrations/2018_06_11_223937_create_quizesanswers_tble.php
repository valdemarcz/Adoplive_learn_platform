<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizesanswersTble extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizesanswers', function (Blueprint $table) {
            $table->increments('id');
            $table->UnsignedInteger('lesson_id');
            $table->UnsignedInteger('max_score');
            $table->UnsignedInteger('result');
            $table->UnsignedInteger('user_id');
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
        Schema::dropIfExists('quizesanswers');
    }
}
