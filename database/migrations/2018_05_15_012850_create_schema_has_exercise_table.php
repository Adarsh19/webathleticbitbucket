<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchemaHasExerciseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schema_has_exercise', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('schema_id');
            $table->integer('exercise_id');
            $table->integer('sets')->nullable();
            $table->integer('reps')->nullable();
            $table->integer('rust')->nullable();
            $table->string('ex_name')->nullable();
            $table->text('ex_meta')->nullable();
            $table->integer('priority');
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
        Schema::dropIfExists('schema_has_exercise');
    }
}
