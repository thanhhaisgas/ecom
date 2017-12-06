<?php

namespace App\Repositories\Eloquent;
use App\Product;
use Illuminate\Http\Request;
Use App\Http\Requests\PayRequest;
use App\Checkout;
use Cart;
use App\Order;
use Kurt\Repoist\Repositories\Eloquent\AbstractRepository;
use App\Repositories\Contracts\CheckoutRepository;
class EloquentCheckoutRepository extends AbstractRepository implements CheckoutRepository
{
    public function __construct(){
        $this->order = new Order;
    }

    public function entity()
    {
        return Checkout::class;
    }

    public function getAllOrder(){
      
        return $this->order->all();

    }


    public function getByIdOrder($id){

        return $this->order->find($id);
    }


    public function createOrder(array $request){

        $this->order->setAddress($request['address']);
        $this->order->setOwner($request['owner']);
        $this->order->setTotal_Price(Cart::getTotal());
        $this->order->setUser_Id(session()->get('login')->id);
        $this->order->setStatus(1);
        return $this->order->save();

        
    }



}