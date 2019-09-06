<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVarktestresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('varktestresults', function (Blueprint $table) {
            $table->increments('id');
            $table->UnsignedInteger('user_id');
            $table->UnsignedInteger('V_res');
            $table->UnsignedInteger('A_res');
            $table->UnsignedInteger('R_res');
            $table->UnsignedInteger('K_res');
            $table->string('style');
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
        Schema::dropIfExists('varktestresults');
    }
}
