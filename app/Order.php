<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table='orders';
    protected $fillabe = ['address','owner','total_price','status','user_id'];
    


    public function getId(){
        return $this->id;
    }
    public function setId($id){
        return $this->id = $id;
    }

    public function getAddress(){
        return $this->address;
    }
    public function setAddress($address){
        return $this->address = $address;
    }

    public function getOwner(){
        return $this->owner;
    }

    public function setOwner($owner){
        return $this->owner = $owner;
    }

    public function getTotal_Pirce(){
        return $this->total_price;
    }

    public function setTotal_Price($total){
        return $this->total_price = $total;
    }

    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status){
        return $this->status = $status;
    }

    public function getUser_Id(){
        return $this->user_id;
    }
    
    public function setUser_Id($userid){
        return $this->user_id = $userid;
    }

    public function getItem(){
        return $this->item;
    }
    public function setItem($item){
        return $this->item= $item;
    }

    public static function getAll(){
        $order_lists = Order::all();
        return $order_lists;
    }

    public static function getByIdOrder($id){
        $find = Order::find($id);
        return $find;
    }

    public static function getByIdOrderLast(){
        $last_id = Order::orderBy("id", 'desc')->first();
       return $last_id;
   }


    public static function CreateOrUpdateOrder(Order $order){
        if($order->id !=-1){
            $order->save();
        }else{
            $order->save();
        }
    }

}
