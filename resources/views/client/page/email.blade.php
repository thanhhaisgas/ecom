

@if(session()->has('cart'))
    Bạn Đã Đặt Thành Công Đơn Hàng, Đơn Hàng Bạn Bao Gồm
    Tên sản phẩm                 Số Lượng
    @foreach(Cart::content() as $item)

    {!!$item->name!!}                      {!!$item->qty!!}
    @endforeach

    Thành tiền: {!!Cart::subtotal()!!} VND
@else


@endif
