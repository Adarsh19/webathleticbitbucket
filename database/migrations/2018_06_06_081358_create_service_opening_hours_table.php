<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceOpeningHoursTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_opening_hours', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('business_days', 12);
			$table->string('business_hours', 500);
			$table->string('min_time', 8);
			$table->string('max_time', 8);
			$table->integer('user_id');
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
		Schema::drop('service_opening_hours');
	}

}
