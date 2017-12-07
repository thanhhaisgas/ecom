@extends('client.layouts.index')
@section('content')
<div class="container">

    <div class="row">
    
        <div class="col-sm-2"></div>
         <div class="col-sm-8">
           @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <strong>Error: </strong><br><br>
                        <ul>
                            @foreach($errors->all() as $item)
                                <li>{{$item}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
            <div class="panel-body">
    <form class="form-horizontal bv-form"  id="address-info"  action="{!! route('checkout.store') !!}" method="post">
<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        <div class="form-group row">
            <label for="full_name" class="col-lg-4 control-label visible-lg-block"> Họ tên </label>
            <div class="col-lg-8 input-wrap has-feedback has-error">
                <input type="text" value="@if(session()->has('login')) {!!session()->get('login')->name!!} @endif" name="fullname" class="form-control address" id="fullname" value="" placeholder="Nhập họ tên" data-bv-field="full_name"><i class="form-control-feedback bv-no-label fa fa-times" data-bv-icon-for="full_name" style="display: block;"></i>
           </div>
        </div>
        <div class="form-group row">
            <label for="full_name" class="col-lg-4 control-label visible-lg-block">Email </label>
            <div class="col-lg-8 input-wrap has-feedback has-error">
                <input type="text" value="@if(session()->has('login')) {!!session()->get('login')->email!!} @endif" name="email" class="form-control address" id="email" value="" placeholder="Nhập họ tên" data-bv-field="full_name"><i class="form-control-feedback bv-no-label fa fa-times" data-bv-icon-for="full_name" style="display: block;"></i>
           </div>
        </div>
        <div class="form-group row">
            <label for="telephone" class="col-lg-4 control-label visible-lg-block">Điện thoại di động</label>
            <div class="col-lg-8 input-wrap has-feedback">
                <input type="tel" name="owner" class="form-control address" id="telephone" value="" placeholder="Nhập số điện thoại" data-bv-field="telephone"><i class="form-control-feedback bv-no-label" data-bv-icon-for="telephone" style="display: none;"></i>
            </div>
        </div>


        

        

        

        <div class="form-group row">
            <label for="street" class="col-lg-4 control-label visible-lg-block">Địa chỉ</label>
            <div class="col-lg-8 input-wrap has-feedback has-error">
                <textarea name="address" class="form-control address" id="street" placeholder="Ví dụ: 52, đường Trần Hưng Đạo" data-bv-field="street"></textarea><i class="form-control-feedback bv-no-label fa fa-times" data-bv-icon-for="street" style=""></i>
                <span class="help-block"></span>
           </div>
        </div>

      


                             
        
        <div class="form-group row">
            <div class="col-lg-offset-4 col-lg-8">
           
                                                <button id="btn-address" type="submit" class="btn btn-primary btn-custom3" value="create">Giao đến địa chỉ này</button>
            </div>
        </div>

</div>
         </div>
      
    </div>
    </form>
</div>

     @endsection