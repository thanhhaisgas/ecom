@extends('client.layouts.index')
@section('content')
<div class="product">
	

			<div class="container">
				@include('client.page.left_product')
				<div class="col-md-9 product1">
				<div class=" bottom-product">
				 <form method="post">
           <input name="_token" type="hidden" value="{!! csrf_token()!!}" />
				@foreach($product_list as $item)
					<div class="col-md-4 bottom-cd simpleCart_shelfItem" style="margin-top:20px;">
						<div class="product-at ">
							<a href="single.html"><img class="img-responsive" src="images/pi3.jpg" alt="">
							<div class="pro-grid">
										<span class="buy-in">Buy Now</span>
							</div>
						</a>	
						</div>
						<p class="tun">{!!$item->name!!}</p>
						
						<a href="cart/{!!$item->id!!}" class="item_add"><p class="number item_price"><i> </i>{!!number_format($item->price)!!}</p></a>						
					</div>

					@endforeach
					</form>
					<div class="clearfix"> </div>
				</div>
				
				
				
				</div>
		<div class="clearfix"> </div>
		<nav class="in">
				  <ul class="pagination">
					<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
					<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
					<li><a href="#">2 <span class="sr-only"></span></a></li>
					<li><a href="#">3 <span class="sr-only"></span></a></li>
					<li><a href="#">4 <span class="sr-only"></span></a></li>
					<li><a href="#">5 <span class="sr-only"></span></a></li>
					 <li> <a href="#" aria-label="Next"><span aria-hidden="true">»</span> </a> </li>
				  </ul>
				</nav>
		</div>
		
		</div>
@endsection