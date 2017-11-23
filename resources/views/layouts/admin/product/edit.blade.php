
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
                  
                        
                       <form method="post" action="{{ route('product.destroy',$product_edit->id)}}"  >
                            <input type="hidden" name="_token" value="{!! csrf_token()!!}"/>
                            <input type="hidden" name="_method" value="PUT"/>
                            <input type="hidden" name="id" value="{{$product_edit->id}}"/>
                           <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                           
                            <div class="form-group">
                                <label>Product Name</label>
                                <input value="{!! $product_edit->name !!}" class="form-control" type="text"  name="name" id="name" placeholder="Please Enter Product Name" />
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" id="price" value="{!! $product_edit->price !!}"  class="form-control" name="price" placeholder="Please Enter Price" />
                            </div>
                            <div class="form-group">
                                <label>Info</label>
                                <textarea placeholder="Please Enter Infod" id="info" name="info" class="form-control" rows="3">{!! $product_edit->info !!}</textarea>
                            </div>
                             <div class="form-group">
                                <label>Review</label>
                                <textarea placeholder="Please Enter Review" id="overview" name="overview" class="form-control" rows="3">{!! $product_edit->overview !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Invetory</label>
                                <input class="form-control"  type="text"  name="inventory" id="inventory" value="{!! $product_edit->inventory !!}" placeholder="Please Enter Inventory" />
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

                            <button type="submit" class="btn btn-default">Edit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
               </form>
                    </div>
                    <div class="col-lg-4" style="padding-bottom:120px">
                        <form id="form_value" action="#" >
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                            <input type="hidden" value="{!!$product_edit->id!!}" id="product_id"/>
                           <div class="form-group">
                                <label> Key</label>
                                <input value="" class="form-control" type="text"  name="keyAttribute" id="keyAttribute" placeholder="Please Enter Product Name" />
                            </div>



                            <div class="form-group">
                                <label> Value</label>
                                <input value="" class="form-control" type="text"  name="valueAttribute" id="valueAttribute" placeholder="Please Enter Product Name" />
                            </div>

                            <button onclick="return confirm('Are you sure ?')" id="btnattribute" class="alert alert-success" type="submit">Add Attribute</button>

                        </form>
                        <div id="datajax"></div>
                        <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Attribute
                         
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Key</th>
                                <th>Value</th>
                           
                       
                            </tr>
                        </thead>
                        <tbody id="dataAttribute">
                        @foreach($attribute as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{!! $item->id!!}</td>
                                <td>{!! $item->name!!}</td>
                                <td>{!! $item->value!!}</td>
                                 
                            </tr>
                
                    @endforeach
                        </tbody>
                    </table>
                </div>
                <br><br><br>
                    </div>
                    
                </div>
                     
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
          @endsection