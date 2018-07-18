<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodProducctUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_producct_units', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('food_product_id');
            $table->string('foodunit',200);
            $table->string('amount',200);
            $table->string('weight',200);
            $table->tinyInteger('setdefault');
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
        Schema::dropIfExists('food_producct_units');
    }
}
