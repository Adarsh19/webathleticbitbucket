<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductgroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productgroup', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('slug', 50);
			$table->integer('parent_id')->default(0);
			$table->string('imagepath')->nullable();
			$table->string('group_type', 20)->default('products');
			$table->integer('user_id')->default(0);
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
		Schema::drop('productgroup');
	}

}
