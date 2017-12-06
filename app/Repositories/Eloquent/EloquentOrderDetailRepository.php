<?php

namespace App\Repositories\Eloquent;

use App\OrderDetail;
Use Cart;
use App\Order;
use App\Repositories\Contracts\OrderDetailRepository;
use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;
use App\Order_Detail;
class EloquentOrderDetailRepository extends AbstractRepository implements OrderDetailRepository
{
    public function entity()
    {
        return OrderDetail::class;
    }


    public function __construct(){

            $this->orderDetail = new Order_Detail;
    }

    public function getAllOrderDetail(){
        return $this->orderDetail->all();
    }


    public function getByIdOrderDetail($id){
        return $this->orderDetail->find($id);


    }


    public function createOrderDetail($object){
            foreach($object as $item){
                $order = new Order_Detail;
                $order->setQuantity($item->qty);
                $order->setPrice($item->qty * $item->price);
                $order->setOrder_Id(Order::getByIdOrderLast()->id);
                $order->setProduct_Id($item->id);
                $order->save();
            }


         
            
    }
}
