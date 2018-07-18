<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceOpeningHoursbkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_opening_hoursbk', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('business_days', 12)->comment('days shown enabled on calendar');
			$table->string('business_hours', 500)->comment('business range');
			$table->string('min_time', 8);
			$table->string('max_time', 8);
			$table->timestamps();
			$table->integer('user_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('service_opening_hoursbk');
	}

}
