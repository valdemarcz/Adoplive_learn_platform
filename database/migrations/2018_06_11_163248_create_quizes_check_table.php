<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizesCheckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizesCheck', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->UnsignedInteger('lesson_id');
            $table->string('var_1');
            $table->string('var_2');
            $table->string('var_3');
            $table->string('var_4');
            $table->Boolean('answer1');
            $table->Boolean('answer2');
            $table->Boolean('answer3');
            $table->Boolean('answer4');
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
        Schema::dropIfExists('quizesCheck');
    }
}
