<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('services', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('service');
			$table->text('sdescription', 65535);
			$table->integer('company_id');
			$table->integer('sprice');
			$table->integer('user_mass');
			$table->integer('payment_time');
			$table->timestamps();
			$table->string('added_by');
			$table->string('bg_color', 7);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('services');
	}

}
