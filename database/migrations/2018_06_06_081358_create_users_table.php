<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->string('username', 100)->unique();
			$table->string('email', 100)->unique();
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
			$table->string('materiallevel')->nullable();
			$table->string('traininglevel')->nullable();
			$table->string('musclegroupname')->nullable();
			$table->string('goal')->nullable();
			$table->string('checkin_text_denied')->nullable();
			$table->string('checkin_text_warning')->nullable();
			$table->string('checkin_text_accept')->nullable();
			$table->string('telefoonnummernood')->nullable();
			$table->string('noodcontact')->nullable();
			$table->string('chronischeziekte')->nullable();
			$table->string('meerinformatie')->nullable();
			$table->string('letsels')->nullable();
			$table->string('hoofddoel')->nullable();
			$table->string('place_holder')->nullable();
			$table->string('name_of_account_holder')->nullable();
			$table->string('bic_code')->nullable();
			$table->string('barcode')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->integer('user_id');
			$table->bigInteger('parent_id')->nullable()->default(1);
			$table->timestamps();
			$table->text('sign');
			$table->integer('packagefk');
			$table->string('first_name', 50);
			$table->string('surname', 50);
			$table->string('city', 50);
			$table->boolean('installed_app')->default(0);
			$table->boolean('browser_extension')->default(0);
			$table->string('latitude', 100);
			$table->string('longitude', 100);
			$table->integer('user_status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
