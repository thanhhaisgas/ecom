<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table='products';
    protected $fillable = ['name','price','info','overview','link','inventory','status'];
    public $timestamps = false;

    public function images(){
        return $this->hasMany('App\Image');
    }
    public function product_attribute(){
        return $this->hasMany('App\Product_Attribute');
    }




}
