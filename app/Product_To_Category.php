<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Product_To_Category extends Model
{
    //
    protected $table='product_to_category';
    protected $fillable = ['product_id','category_id'];
    public $timestamps = false;

    public function getProduct_id(){
        return $this->product_id;
    }
    public function setProduct_id($product_id){
        return $this->product_id=$product_id;
    }

    public function getCategory_id(){
        return $this->category_id;
    }
    public function setCategory_id($category_id){
        return $this->category_id=$category_id;
    }


    public static function CreateProduct_To_Category(Product_To_Category $model){
        $model->save();
    }

    public static function getByIdProduct_To_Category($id){
        $find= Product_To_Category::find($id);
        return $find;
    }



    public static function DeleteProduct_To_Category($id){
        Product_To_Category::where('product_id',$id)->delete();

    }

 
}
