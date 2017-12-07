<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Product extends Model
{
    //
    protected $table='products';
    protected $fillable = ['id','name','price','info','overview','link','inventory','status'];
    public $timestamps = false;
    
/* 
     public function __constructor($name,$price,$info,$overview,$link,$inventory,$status){
        $this->name = $name;
        $this->price = $price;
        $this->info = $info;
        $this->overview=$overview;
        $this->link=$link;
    }  */
    public function __constructor(){

    }

    public  function images(){
        return $this->hasMany('App\Image');
    }


    public function product_attribute(){
        return $this->hasMany('App\Product_Attribute');
    }

    public function setId($id){
        return $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }

    public function setName($name){
        return $this->name=$name;
    }
    public function getName(){
        return $this->name;
    }

    public function setPrice($price){
        return $this->price=$price;
    }
    public function getPrice(){
        return $this->price;
    }

    public function setInfo($info){
        return $this->info=$info;
    }
    public function getInfo(){
        return $this->info;
    }

    public function setOverview($overview){
        return $this->overview=$overview;
    }
    public function getOverview(){
        return $this->overview;
    }

    public function setLink($link){
        return $this->link=$link;
    }
    public function getLink(){
        return $this->link;
    }

    public function setInventory($inventory){
        return $this->inventory=$inventory;
    }
    public function getInventory(){
        return $this->inventory;
    }

    public function setStatus($status){
        return $this->status=$status;
    }
    public function getStatus(){
        return $this->status;
    }


    //getAll
    public static function getAll(){
        $product_list = Product::all();
        return $product_list;
    }

     //get id last
     public static function getByIdProductLast(){
         $last_id = Product::orderBy("id", 'desc')->first();
        return $last_id;
    }

    //get product by Id
    public static function getByIdProduct($id){
        $find = Product::find($id);
        return $find;
    }
    

    //create ,update
    public static function CreateOrUpdateProduct(Product $product){
        if($product->id !=-1){
            $product->save(); 
        }else{
            $product->save();
        }
       
    }

    //delete
    public static function DeleteProduct($id){
        Product::getByIdProduct($id)->delete();
        
    }

    /*Hai Nguyen*/
    //get all products exist in idsProductList
    public static function getProductsInCategory($idCategory){
        $idsProductList = Product_To_Category::getProductsByCategoryID($idCategory);
        $listProducts = array();
        foreach ($idsProductList as $item) {
            array_push($listProducts, Product::getByIdProduct($item->product_id));
        }
        return $listProducts;
    }
    //getLimitProsucts
    public static function getPaginationProducts(array $listProducts, $currentPage){
        $to = $currentPage*9;
        $from = $to - 9;
        $count = 0;
        $listLimitProducts = array();
        if ($to>count($listProducts)) {
            for ($i=$from; $i<count($listProducts) ; $i++) { 
            array_push($listLimitProducts, $listProducts[$i]);
            $count = ++$count;
        }
        }else{
            for ($i=$from; $i<$to ; $i++) { 
            array_push($listLimitProducts, $listProducts[$i]);
            $count = ++$count;
        }
        }
        return $listLimitProducts;
    }

}
