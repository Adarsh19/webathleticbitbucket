<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceEventExceptionsbkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_event_exceptionsbk', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('event_id');
			$table->dateTime('exdate');
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
		Schema::drop('service_event_exceptionsbk');
	}

}
