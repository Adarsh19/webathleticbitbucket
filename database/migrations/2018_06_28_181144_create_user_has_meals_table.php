<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHasMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_meals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('food_product_id');
            $table->integer('eatan_at');
            $table->date('date');
            $table->integer('quantity');
            $table->integer('units');
            $table->integer('user_id');  #who added this entry as user himself or admin can do this
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
        Schema::dropIfExists('user_has_meals');
    }
}
