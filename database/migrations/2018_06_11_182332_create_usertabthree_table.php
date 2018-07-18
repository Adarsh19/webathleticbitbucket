<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsertabthreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usertabthree', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('datum');
            $table->string('borst');
            $table->string('heup');
            $table->string('buik');
            $table->string('onderrug');
            $table->string('quadricep');
            $table->string('adductoren');
            $table->string('kuiten');
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
        Schema::dropIfExists('usertabthree');
    }
}
