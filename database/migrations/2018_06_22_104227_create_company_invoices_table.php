<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_invoices', function (Blueprint $table) {
            $table->increments('company_invoice_id');
			$table->string('invoice_number', 255)->nullable();
			$table->integer('package_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('quantity')->unsigned();
			$table->string('total_amount', 50)->nullable();
			$table->date('invoice_date');
			$table->date('due_date');
			$table->integer('expand_automatically')->unsigned();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_invoices');
    }
}
