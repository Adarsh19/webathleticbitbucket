<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCompanyUI extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companyUI', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('header', 6)->nullable();
            $table->string('footer', 6)->nullable();
            $table->string('sidemenu', 6)->nullable();
            $table->string('background', 6)->nullable();
            $table->string('text', 6)->nullable();
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
        Schema::drop('companyUI');
    }
}
