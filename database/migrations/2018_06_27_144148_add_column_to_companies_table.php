<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
			$table->dateTime('last_invoice_date')->default(DB::raw('CURRENT_TIMESTAMP'))->after('logo'); 
            $table->string('last_invoice_number', 255)->default(mt_rand(1000,10000000))->after('last_invoice_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('last_invoice_date');
            $table->dropColumn('last_invoice_number');
        });
    }
}
