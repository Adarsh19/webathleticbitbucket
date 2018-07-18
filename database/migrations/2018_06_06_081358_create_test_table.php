<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('test', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->string('username', 100)->unique('users_username_unique');
			$table->string('email', 100)->unique('users_email_unique');
			$table->string('password');
			$table->string('avatar')->nullable();
			$table->string('gender')->nullable();
			$table->string('phone')->nullable();
			$table->string('address')->nullable();
			$table->date('birthday')->nullable();
			$table->string('iban')->nullable();
			$table->string('taal')->nullable();
			$table->date('klant_sinds')->nullable();
			$table->text('about', 65535)->nullable();
			$table->text('user_meta', 65535)->nullable();
			$table->string('role', 50);
			$table->boolean('activation_status')->default(0);
			$table->string('block_reason')->nullable();
			$table->dateTime('blocked_at')->nullable();
			$table->string('place_holder')->nullable();
			$table->string('name_of_account_holder')->nullable();
			$table->string('bic_code')->nullable();
			$table->string('barcode')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->integer('user_id');
			$table->bigInteger('parent_id')->nullable()->default(1);
			$table->string('Bedrijfsnaam')->nullable();
			$table->string('Soort')->nullable();
			$table->string('City')->nullable();
			$table->string('Contactpersoon')->nullable();
			$table->string('cashback')->nullable();
			$table->timestamps();
			$table->string('slug');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('test');
	}

}
