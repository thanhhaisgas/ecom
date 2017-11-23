@extends('layouts.admin.index')
@section('content')
 <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add User
                        
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
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
                        <form method="POST" action="{!! route('product.store') !!}" enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                           <div class="form-group">
                                <label>Category</label>
                                <select name="cbcategory" class="form-control">
                                @foreach($category_list as $item)
                                    <option value="{!!$item->id!!}">{!!$item->name!!}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Product Name</label>
                                <input class="form-control" type="text"  name="name" id="name" placeholder="Please Enter Product Name" />
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" id="price"  class="form-control" name="price" placeholder="Please Enter Price" />
                            </div>
                            <div class="form-group">
                                <label>Info</label>
                                <textarea placeholder="Please Enter Infod" id="info" name="info" class="form-control" rows="3"></textarea>
                            </div>
                             <div class="form-group">
                                <label>Review</label>
                                <textarea  placeholder="Please Enter Review" id="editor1" name="overview" class="form-control" rows="3"></textarea>
      
                            </div>

                            <div class="form-group">
                                <label>Invetory</label>
                                
                                <input class="form-control"  type="text"  name="inventory" id="inventory" placeholder="Please Enter Inventory" />
                            </div>

                            <div class="form-group">
                                <label>Images</label>
                                
                                <input class="form-control"  type="file" multiple name="file[]" id="file" placeholder="Please Enter Inventory" />
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <label class="radio-inline">
                                    <input name="cbright" value="1"  checked="" type="radio">Show
                                </label>
                                <label class="radio-inline">
                                    <input name="cbright" value="0" type="radio">Hidden
                                </label>
                            </div>

                            <button type="submit" class="btn btn-default">Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
          @endsection