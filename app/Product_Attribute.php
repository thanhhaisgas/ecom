<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Attribute extends Model
{
    //
    protected $table = 'product_attribute';
    protected $fillable = ['name','value','product_id'];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo('App\Product');
    }
}
