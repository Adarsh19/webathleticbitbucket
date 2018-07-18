<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsbkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactionsbk', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->decimal('amount_debt', 10);
			$table->decimal('amount_received', 10);
			$table->string('transaction_type', 50);
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
		Schema::drop('transactionsbk');
	}

}
