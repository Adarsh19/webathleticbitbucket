<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceScheduleHasUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_schedule_has_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('service_schedule_id');
			$table->integer('user_id');
			$table->boolean('bookflag');
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
		Schema::drop('service_schedule_has_users');
	}

}
