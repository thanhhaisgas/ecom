<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table='images';
    protected $fillable = ['id','url','product_id'];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo('App\Product');
    }


    public function getId(){
        return $this->id;
    }
    public function setId($id){
        return $this->id= $id;
    }

    public function getUrl(){
        return $this->url;
    }
    public function setUrl($url){
        return $this->url= $url;
    }

    public function getProduct_id(){
        return $this->product_id;
    }
    public function setProduct_id($product_id){
        return $this->product_id = $product_id;
    }


    public function Image_Create_Many(array $files){
         foreach($files as $item){
            $this->insert([
                'url'=>$item,
                'product_id'=>$this->getProduct_id(),
            ]);
        } 

    }

    public static function getByIdImage($id){
        $find = Image::find($id);
        return $find;
    }


    //get image follwing product_id
    public static function getByImageProduct_id($id){
        $find = Image::where('product_id',$id)->get()->toArray();
        return $find;
    }
    public static function DeleteImageProduct_id($id){
        Image::where('product_id',$id)->delete();
    }



}
