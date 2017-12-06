<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Image;
use Cart;
class indexController extends Controller
{
    //
    public function index(){

        
            $product_list = Product::getAll();
            $cart = Cart::content();



        return view('client.page.product')->with(['product_list'=>$product_list,'cart'=>$cart]);
    }
}
