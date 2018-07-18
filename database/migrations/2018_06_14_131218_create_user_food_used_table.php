<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFoodUsedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_food_used', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->datetime('date');
            $table->string('kcal');
            $table->string('eiwit');
            $table->string('koolhydraat');
            $table->string('vezel');
            $table->string('vet');
            $table->string('kcal_baw');
            $table->string('eiwit_baw');
            $table->string('koolhydraat_baw');
            $table->string('vezel_baw');
            $table->string('vet_baw');
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
        Schema::dropIfExists('user_food_used');
    }
}
