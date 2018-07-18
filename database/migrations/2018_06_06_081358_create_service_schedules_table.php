<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceSchedulesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_schedules', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('color', 7);
			$table->enum('hidden', array('yes','no'));
			$table->integer('user_id');
			$table->integer('role');
			$table->boolean('dragdrop');
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
		Schema::drop('service_schedules');
	}

}
