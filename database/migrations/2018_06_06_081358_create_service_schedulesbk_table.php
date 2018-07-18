<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceSchedulesbkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_schedulesbk', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('color', 7);
			$table->enum('hidden', array('yes','no'))->default('no');
			$table->integer('user_id');
			$table->timestamps();
			$table->integer('role')->nullable();
			$table->boolean('dragdrop')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('service_schedulesbk');
	}

}
