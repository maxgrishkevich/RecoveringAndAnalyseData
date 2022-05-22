<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLvivTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lviv', function (Blueprint $table) {
            $table->bigIncrements('id')->primary()->nullable(false);
            $table->integer("month")->nullable(false)->unsigned();
            $table->integer("day")->nullable(false)->unsigned();
            $table->time("time")->nullable(false);
            $table->integer('temperature')->nullable(false);
            $table->string("wind direction")->nullable(false);
            $table->integer("wind speed")->nullable(false)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lviv');
    }
}
