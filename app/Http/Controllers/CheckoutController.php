<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayRequest;
use App\Order;
use App\Repositories\Contracts\CheckoutRepository;
use App\Repositories\Contracts\OrderDetailRepository;
use Cart;
use Illuminate\Http\Request;
use Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CheckoutRepository $checkout,OrderDetailRepository $orderDetail){
        $this->CheckoutRepository = $checkout;
        $this->OrderDetailRepository = $orderDetail;
    }
    
    public function index()
    {
        //
        $order  = new Order;
        $cart = Cart::content();


        
        return view('client.page.checkout')->with('cart',$cart);
    }

    public function pay(){
        
        if(session()->has('login')){
            return view('client.page.pay');
        }else{
            return redirect('login_user');
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PayRequest $request)
    {
    

        $this->CheckoutRepository->createOrder($request->all()); 
        
        $this->OrderDetailRepository->createOrderDetail(Cart::content());

        $this->sendEmail();
        session()->forget('cart');
        session()->flash('notification', 'Bạn đã đặt thành công, Bạn vui lòng kiểm tra email...');

        return  redirect('/');  
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sendEmail(){
     
        Mail::send(['text'=>'client.page.email'], ['name'=>'reer'], function ($message) {
            $message->from('darkwinqw1@gmail.com', 'Intership');
    
            $message->to(session()->get('login')->email, 'Intership')->subject('Intership');
         
        });
        
    }
}
