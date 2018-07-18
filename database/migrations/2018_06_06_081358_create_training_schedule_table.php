<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrainingScheduleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('training_schedule', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('schema_id');
			$table->enum('recurring', array('yes','no'))->nullable();
			$table->dateTime('startdate')->nullable();
			$table->dateTime('enddate')->nullable();
			$table->string('days', 14)->nullable();
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
		Schema::drop('training_schedule');
	}

}
