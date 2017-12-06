<?php

namespace App\Repositories\Eloquent;

use App\Product;
use App\Image;
use App\Product_To_Category;
use App\Repositories\Contracts\ProductRepository;
use Storage;
use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;

class EloquentProductRepository extends AbstractRepository implements ProductRepository
{
    public function entity()
    {
        return Product::class;
    }
    public function __construct(Product $product,Product_To_Category $category){
        $this->product= $product;
        $this->category = $category;
    }
    public function getAll(){
        return $this->product->all();
    }
    public function getById($id){

    }


    //product id final
    public function getByIdFirst($name){
        return $this->product->orderBy("$name", 'desc')->first();
    }




    //insert product
    public function createProduct(array $attribute,$name,$idcat,$file){
        //insert product
        $product_add = $this->product->create($attribute);
        //insert category_to_product
        $category_to_product = $this->category->create(['category_id'=>$idcat,'product_id'=>$this->getByIdFirst($name)->id]);



        //insert Image
        
        $images = array();
        foreach($file as $item){
            $images[]=$item->getClientOriginalName();
            Storage::disk('public')->put($item->getClientOriginalName(), file_get_contents($item));
         }
         print_r($images);
         foreach($images as $teo){
            Image::insert([
                'url'=>$teo,
                'product_id'=>$this->getByIdFirst($name)->id,
            ]);
        }


        return true;


    }
   
}
