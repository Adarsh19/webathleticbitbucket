<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserHasProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_has_products', function(Blueprint $table)
		{
			$table->integer('userid');
			$table->integer('productid');
			$table->integer('quantity');
			$table->decimal('price', 10);
			$table->string('name', 80);
			$table->decimal('tax', 10);
			$table->integer('orderid');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_has_products');
	}

}
