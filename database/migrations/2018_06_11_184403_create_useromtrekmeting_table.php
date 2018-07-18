<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUseromtrekmetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('useromtrekmeting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('datum');
            $table->string('borst');
            $table->string('schouder');
            $table->string('buik');
            $table->string('armlinks');
            $table->string('armrechts');
            $table->string('bovenbeenlinks');
            $table->string('bovenbeenrechts');
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
        Schema::dropIfExists('useromtrekmeting');
    }
}
