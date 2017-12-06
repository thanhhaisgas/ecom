<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Cart;
use App\Image;
use App\Product;
use App\CartDemo;
use App\Http\Requests;               
class CartController extends Controller
{
    /**
     * @param Request $request
     * @param $id
     */
    public function getAddToCart(Request $request, $id){
        

     
       $product =Product::getByIdProduct($id);
  
        Cart::add(array('id'=>$id,'name'=>$product->name,'qty'=>1,'price'=>$product->price,'options' => ['img' => $product->images->first(),'teo'=>5]));
        Cart::tax();    
        return back()->withInput();
        
      
       
    }

    public function pay(){
        if(session()->has('login')){
            return view('client.page.pay');
        }else{
            return back()->withInput();
        }
        
    }

    public function getDeleteCart($id){
        Cart::remove($id);
        return redirect('checkout');
    }

    public function UpdateCart($id,$qty){
        echo $qty;
       Cart::update($id,$qty);
        
    }
}
