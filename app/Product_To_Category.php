<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_To_Category extends Model
{
    //
    protected $table='product_to_category';
    protected $fillable = ['product_id','category_id'];
    public $timestamps = false;

/*     public function category(){
        return 
    }
 */
}
