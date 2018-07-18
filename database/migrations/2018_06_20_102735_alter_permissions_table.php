<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('permissions', function(Blueprint $table)
        {
            $table->string('route_name');
            $table->string('dependent_routes');
            $table->string('block_name');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function(Blueprint $table)
        {
            $table->dropColumn('route_name');
            $table->dropColumn('dependent_routes');
            $table->dropColumn('block_name');
        });
    }
}
