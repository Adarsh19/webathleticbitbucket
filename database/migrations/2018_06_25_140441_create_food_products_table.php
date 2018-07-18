<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('merk')->nullable();
            $table->string('beshchrijving')->nullable();
            $table->string('synoniemen')->nullable();
            $table->integer('nutrition_grams')->nullable();
            $table->integer('kal')->nullable();
            $table->integer('eiwit')->nullable();
            $table->integer('totaal')->nullable();
            $table->integer('koolhydraten')->nullable();
            $table->integer('suikers')->nullable();
            $table->integer('verzadigd')->nullable();
            $table->integer('kilojoule')->nullable();
            $table->integer('voedingsvezels')->nullable();
            $table->integer('calcium')->nullable();
            $table->integer('ijzer')->nullable();
            $table->integer('magnesium')->nullable();
            $table->integer('fosfor')->nullable();
            $table->integer('kalium')->nullable();
            $table->integer('natrium')->nullable();
            $table->integer('zink')->nullable();
            $table->integer('koper')->nullable();
            $table->integer('selenium')->nullable();
            $table->integer('vitc')->nullable();
            $table->integer('vitb1')->nullable();
            $table->integer('vitb2')->nullable();
            $table->integer('vitb6')->nullable();
            $table->integer('foliumzuur')->nullable();
            $table->integer('vitb12')->nullable();
            $table->integer('vita')->nullable();
            $table->integer('vite')->nullable();
            $table->integer('vitd')->nullable();
            $table->integer('onverzadigdevetzuren')->nullable();
            $table->integer('cholesterol')->nullable();
            $table->integer('alcohol')->nullable();
            $table->integer('onverzvet')->nullable();
            $table->integer('meervonverzvet')->nullable();
            $table->integer('transvet')->nullable();
            $table->string('slug',100);
            $table->text('path')->nullable();
            $table->string('barcode',255)->nullable();
            $table->integer('category');
            $table->integer('user_id');
            $table->integer('group_id');
            $table->decimal('price',10,2);
            $table->decimal('tax',10,2);
            $table->integer('group_priority')->default(0);
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
        Schema::dropIfExists('food_products');
    }
}
