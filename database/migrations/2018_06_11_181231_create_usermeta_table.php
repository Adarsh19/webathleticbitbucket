<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsermetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usermeta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->date('date');
            $table->string('kcal');
            $table->string('weight');
            $table->string('training');
            $table->string('sleep_q1');
            $table->string('sleep_q2');
            $table->string('sleep_q3');
            $table->string('sleep_q4');
            $table->string('daily_note');
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
        Schema::dropIfExists('usermeta');
    }
}
