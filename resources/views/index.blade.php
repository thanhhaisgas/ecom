
<!DOCTYPE HTML>
<html>
<head>
<title>Website Template </title>


<link href="{{asset('bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css"  />
<!-- Latest compiled and minified CSS -->


<!-- Latest compiled and minified JavaScript -->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

<script src="{{asset('login/js/jquery.min.js')}}"></script>
<script src="{{asset('login/js/myjs.js')}}" ></script>

<script src="{{asset('js/md5.min.js')}}" ></script>
</head>
<body>
 <div class="wrapper">
    @if(session()->has('login'))
       {!! session()->get('login')->email !!}
           <br>
    <a href="logout">Logout</a>
    @else

  Chua login
  @endif
  </div>
            <table border="1" width="500">
              <tr>
                <td>Ma</td>
                <td>Ten</td>
                <td>gia</td>
                <td>action</td>
              </tr>
              @foreach($product_list as $item)
              <tr>
                <td>{!!$item->id!!}</td>
                <td>{!!$item->name!!}</td>
                <td>{!!$item->price!!}</td>
                <td><a href="{!!route('product.addToCart',['id'=>$item->id])!!}" >Dat Hang</a></td>
              </tr>
              @endforeach
            </table>
           <div>GioHang:<span>{{Session::has('cart')?  Cart::count() :''}}</span></div>
           <form method="post">
           <input name="_token" type="hidden" value="{!! csrf_token()!!}" />
           @if(Session::has('cart'))
               <table border="1" width="500">
              <tr>
                <td>Ma</td>
                <td>Ten</td>
                <td>gia</td>
                   <td>SL</td>
                   <td>Total</td>
                <td>action</td>
              </tr>
              @foreach($cart as $item)
              <tr>
                <td>{!!$item->id!!}</td>
                <td>{!!$item->name!!}</td>
                <td>{!!$item->price!!}</td>
                <td><input type="text" value="{!!$item->qty!!}" id="qty" class="qty"/></td>
                <td>{!!$item->qty*$item->price!!}</td>
                <td><a href="#" idcart="{!!$item->rowId!!}" class="editcart" id="editcart">Sua</a>
                <a href="{!!route('product.deleteCart',['id'=>$item->rowId])!!}" >Xoa</a>
                </td>
              </tr>
              @endforeach
            </table>
            <div>tongtien:{{Cart::total()}}</div>
           @endif
           </form>

</body>
<script>
$(document).ready(function(){
  $('.editcart').click(function(e){
    e.preventDefault();
    var id= $('.editcart').attr('idcart');
    var qty = $('.editcart').parent().parent().find(".qty").val();
  alert(5);
    $.ajax({
      url:'cart-update/'+id+'/'+qty,
      type:'GET',
      cache:false,
      data:{"id":id,"qty":qty},`
      success:function(data){
  
     location.reload();
      }
    });   

  })
});
</script>
</html>