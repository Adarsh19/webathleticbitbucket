<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePackagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('packages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('days')->default(0);
			$table->integer('credits')->default(0);
			$table->integer('products')->default(0);
			$table->integer('pro_rato')->default(0);
			$table->boolean('expand_automatically')->default(0);
			$table->integer('Start_fee')->default(0);
			$table->integer('entree')->default(0);
			$table->string('sell_category')->default('0');
			$table->integer('enquette')->default(0);
			$table->timestamps();
			$table->integer('role_id');
			$table->integer('user_id');
			$table->integer('max_users');
			$table->string('added_by');
			$table->text('payment_days');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('packages');
	}

}
