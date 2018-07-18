<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_events', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->dateTime('start');
			$table->dateTime('end');
			$table->boolean('all_day');
			$table->integer('service_schedule_id');
			$table->string('app_id', 20);
			$table->string('location')->nullable();
			$table->string('notes', 500)->nullable();
			$table->string('url');
			$table->string('reminder', 200);
			$table->string('rrule', 200);
			$table->integer('duration');
			$table->boolean('editable');
			$table->enum('can_user_book', array('1','0'))->default('0');
			$table->string('backgroundColor', 7);
			$table->string('borderColor', 7);
			$table->integer('service_id');
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
		Schema::drop('service_events');
	}

}
