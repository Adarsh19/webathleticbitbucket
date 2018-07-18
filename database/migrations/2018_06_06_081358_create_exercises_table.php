<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExercisesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exercises', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 200);
			$table->decimal('price', 10);
			$table->decimal('tax', 10);
			$table->string('slug', 100);
			$table->text('path', 65535)->nullable();
			$table->integer('user_id')->default(0);
			$table->integer('group_id')->default(0);
			$table->integer('group_priority')->default(0);
			$table->string('barcode')->default('0');
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
		Schema::drop('exercises');
	}

}
