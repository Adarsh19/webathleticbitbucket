<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceEventsbkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_eventsbk', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title');
			$table->dateTime('start');
			$table->dateTime('end');
			$table->boolean('all_day')->nullable()->default(0);
			$table->integer('service_schedule_id')->nullable()->comment('map with service schedules');
			$table->string('app_id', 20);
			$table->string('location')->nullable();
			$table->text('notes', 65535)->nullable();
			$table->string('url')->nullable();
			$table->string('reminder')->nullable();
			$table->string('rrule', 999)->nullable();
			$table->integer('duration')->nullable();
			$table->boolean('editable')->comment('draggable true false');
			$table->enum('can_user_book', array('1','0'))->default('0');
			$table->timestamps();
			$table->string('backgroundColor', 7)->nullable();
			$table->string('borderColor', 7)->nullable();
			$table->integer('service_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('service_eventsbk');
	}

}
