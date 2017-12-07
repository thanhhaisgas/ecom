<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    //
    protected $table='order_detail';
    protected $fillabe = ['quantity','price','order_id','product_id'];

     public function getQuantity(){
         return $this->quantity;
     }
     public function setQuantity($quantity){
         return $this->quantity = $quantity;
     }

     public function getPrice(){
         return $this->price;
     }
     public function setPrice($price){
         return $this->price= $price;
     }

     public function getOrder_Id(){
         return $this->order_id;
     }
     public function setOrder_Id($order_id){
         return $this->order_id = $order_id;
     }

     public function getProduct_Id(){
         return $this->product_id;
     }
     public function setProduct_Id($product_id){
         return $this->product_id=$product_id;
     }

     public function getItem(){
        return $this->item;
    }
    public function setItem($item){
        return $this->item= $item;
    }

    
     public static function CreateOrUpdateOrderDetail(Order_Detail $order){
        if($order->id !=-1){
            $order->save();
        }else{
            $order->save();
        }
    }
}
