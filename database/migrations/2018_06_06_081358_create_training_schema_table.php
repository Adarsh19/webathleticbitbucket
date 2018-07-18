<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrainingSchemaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('training_schema', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id');
			$table->string('schema_name', 200)->nullable();
			$table->text('schema_note', 65535)->nullable();
			$table->enum('status', array('incomplete','complete'));
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
		Schema::drop('training_schema');
	}

}
