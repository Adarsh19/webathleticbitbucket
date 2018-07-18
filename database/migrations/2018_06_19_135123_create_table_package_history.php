<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePackageHistory extends Migration
{
   
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_history', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('type')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('causer_id')->nullable();
            $table->integer('package_id')->nullable();
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
        Schema::drop('package_history');
    }

}
