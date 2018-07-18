<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceScheduleHasUsersbkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_schedule_has_usersbk', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('service_schedule_id');
			$table->integer('user_id');
			$table->boolean('bookflag')->comment('is reservate or not');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('service_schedule_has_usersbk');
	}

}
