<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPermissionsColTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasColumn('permissions', 'dependent_routes'))
        {
            Schema::table('permissions', function (Blueprint $table)
            {
                $table->dropColumn('dependent_routes');
            });
        }
        if (Schema::hasColumn('permissions', 'user_id'))
        {
            Schema::table('permissions', function(Blueprint $table)
            {
                $table->dropColumn('user_id');
            });
        }
        Schema::table('permissions', function(Blueprint $table)
        {
            $table->string('parent_route')->nullable(true);
            $table->text('pdescription')->nullable(true)->change();
            $table->string('added_by')->nullable(true)->change();
            $table->string('block_name')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        if (!Schema::hasColumn('permissions', 'dependent_routes'))
        {
            Schema::table('permissions', function(Blueprint $table)
            {
                $table->string('dependent_routes');
            });
        }
        if (!Schema::hasColumn('permissions', 'user_id'))
        {
            Schema::table('permissions', function(Blueprint $table)
            {
                $table->integer('user_id');
            });
        }
        Schema::table('permissions', function(Blueprint $table)
        {
            $table->dropColumn('parent_route');
            $table->text('pdescription')->nullable(false)->change();
            $table->string('added_by')->nullable(false)->change();
            $table->string('block_name')->nullable(false)->change();
        });

    }
}
