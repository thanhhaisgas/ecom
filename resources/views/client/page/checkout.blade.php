@extends('client.layouts.index')
@section('content')
<div class="container">
	<div class="check">	 
			 <h1>My Shopping Bag (@if(Session::has('cart')){{Cart::count()}}@endif)</h1>
		 <div class="col-md-9 cart-items">
			@foreach($cart as $item)
				
					
				
			 <div class="cart-header">
				 <a href="cart-delete/{!!$item->rowId!!}"><div class="close1"> </div></a>
				 <div class="cart-sec simpleCart_shelfItem">
						<div class="cart-item cyc">
				
						
							 <img  src="{{ URL::to('/storage/'.$item->options->img->url ) }}" class="img-responsive" alt="">
					
						</div>
					   <div class="cart-item-info">
						<h3><a href="#">{!!$item->name!!}</a></h3>
						<ul class="qty">
							<li><p>Size : 5</p></li>
							<li><p>Qty : <input style="width:50px;height:30px;font-size:15px;" type="number" value="{!!$item->qty!!}" id="qty_{!!$item->id!!}" class="qty" idcart="{!!$item->rowId!!}"  /><a href="#" idcart="{!!$item->rowId!!}" class="editcart{!!$item->id!!}" id="editcart{!!$item->id!!}"> </a></p></li>
						</ul>
						
							 <div class="delivery">
							 <p>Price : {!!number_format($item->price)!!}</p>
							 <span>Delivered in 2-3 bussiness days</span>
							 <div class="clearfix"></div>
				        </div>	
					   </div>
					   <div class="clearfix"></div>
											
				  </div>
			 </div>
			 	 <script>
$(document).ready(function(){
  $('#qty_{!!$item->id!!}').change(function(e){
    e.preventDefault();
    var id= $('.editcart{!!$item->id!!}').attr('idcart');
    var qty = $('.editcart{!!$item->id!!}').parent().parent().find(".qty").val();
	
    $.ajax({
      url:'cart-update/'+id+'/'+qty,
      type:'GET',
      cache:false,
      data:{"id":id,"qty":qty},
      success:function(data){
  
     location.reload();
      }
    });   

  })
});
</script>
				@endforeach
		 </div>
		  <div class="col-md-3 cart-total">
			 <a class="continue" href="#">Price Details</a>
			 <div class="price-details">
			
				 <span>Product</span>
				 <span class="total1">Quantity</span>
				@foreach($cart as $item)
					<span>{!!$item->name!!}</span>
				 <span class="total1">{!!$item->qty!!}</span>
				@endforeach

				 
				 <div class="clearfix"></div>				 
			 </div>	
			 <ul class="total_price">
			   <li class="last_price"> <h4>TOTAL</h4></li>	
			   <li class="last_price"><span>{!!Cart::subtotal()!!}</span></li>
			   <div class="clearfix"> </div>
			 </ul>
			
			 
			 <div class="clearfix"></div>
			<br><br>
			<a class="continue" href="pay">Checkout</a>
			</div>
		
			<div class="clearfix"> </div>
	 </div>
	 </div>

     @endsection