<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Attribute extends Model
{
    //
    protected $table = 'product_attribute';
    protected $fillable = ['id','name','value','product_id'];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function setId($id){
        return $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }


    public static function getByIdAttribute($id){
        $find = Product_Attribute::where('product_id',$id)->get();
        return $find;

    }

    //delete
    public static function DeleteAttribute($id){
         Product_Attribute::find($id)->delete();
    }


    //delete attribute follwing product_id
    public static function DeleteAttributeProduct_id($id){
        Product_Attribute::where('product_id',$id)->delete();
    }
}
