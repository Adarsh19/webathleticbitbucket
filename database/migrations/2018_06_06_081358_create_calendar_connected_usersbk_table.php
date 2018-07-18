<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCalendarConnectedUsersbkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('calendar_connected_usersbk', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('parent_user_id');
			$table->string('user_color_code', 7);
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
		Schema::drop('calendar_connected_usersbk');
	}

}
