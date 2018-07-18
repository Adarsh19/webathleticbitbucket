<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('userid');
			$table->decimal('balance', 10);
			$table->decimal('invoiceamount', 10);
			$table->enum('status', array('paid','incomplete'));
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
		Schema::drop('user_orders');
	}

}
