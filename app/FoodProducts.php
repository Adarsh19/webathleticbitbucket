<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodProducts extends Model {



    public $table = "food_products";
    protected $fillable = [
        'id','name', 'slug', 'path', 'user_id','price','tax','group_id','group_priority','barcode','merk','beshchrijving','synoniemen','nutrition_grams','kal','eiwit','totaal','koolhydraten','suikers', 'verzadigd', 'kilojoule',
'voedingsvezels',
'calcium',
'ijzer',
'magnesium',
'fosfor',
'kalium',
'natrium',
'zink',
'koper',
'selenium',
'vitc',
'vitb1',
'vitb2',
'vitb6',
'foliumzuur',
'vitb12',
'vita',
'vite',
'vitd',
'onverzadigdevetzuren',
'cholesterol',
'alcohol',
'onverzvet',
'meervonverzvet',
'transvet','category'
    ];


}
