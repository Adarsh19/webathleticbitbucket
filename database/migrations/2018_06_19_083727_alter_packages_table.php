<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function(Blueprint $table)
        {
            $table->integer('company_id');
            $table->string('bg_color');
            $table->float('day_price');
        });
        if (Schema::hasColumn('packages', 'products'))
        {
            Schema::table('packages', function (Blueprint $table)
            {
                $table->dropColumn('products');
            });
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function(Blueprint $table)
        {
            $table->dropColumn('company_id');
            $table->dropColumn('bg_color');
            $table->dropColumn('day_price');
        });
    }

}