<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiteImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_images', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 1024)->nullable();
			$table->string('src', 1024)->nullable();
			$table->string('title', 1024)->nullable();
			$table->string('description', 1024)->nullable();
			$table->string('type', 1024)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('site_images');
	}

}
