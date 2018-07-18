<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductmediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productmedia', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 80);
			$table->decimal('price', 10);
			$table->decimal('tax', 10);
			$table->integer('stock');
			$table->string('category');
			$table->integer('unlimited_stock');
			$table->string('slug', 100)->unique();
			$table->string('type');
			$table->text('path', 65535)->nullable();
			$table->integer('user_id')->default(0);
			$table->integer('group_id')->nullable();
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
		Schema::drop('productmedia');
	}

}
