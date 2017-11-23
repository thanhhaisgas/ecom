@extends('layouts.admin.index')
@section('content')
<!-- Page Content -->
       <div id="page-wrapper" style="min-height: 494px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>List</small>
                        </h1>
                    </div>
            
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    @if(isset($error_insert))
                        <div class="alert alert-danger">{!!$error_insert!!}</div>
                    @endif
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Link</th>
                                <th>Price</th>
                                <th>Inventory</th>
                                <th>Delete</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($product_list as $item)
                    
                            <tr class="odd gradeX" align="center">
                                <td>{!! $item->id !!}</td>
                                <td>{!! $item->name !!}</td>
                                <td><a href='{!!URL::to("$item->link/p$item->id")!!}'>{!! $item->name !!}<a></td>
                                <td>{!! number_format($item->price)!!} VND</td>
                                <td>{!! $item->inventory !!}</td>
                                <td class="center">
                                        <form method="post" action="{{ route('product.destroy',$item->id)}}"  >
                            <input type="hidden" name="_token" value="{!! csrf_token()!!}"/>
                            <input type="hidden" name="_method" value="DELETE"/>
                            <input type="hidden" name="id" value="{{$item->id}}"/>
                                <button type="submit"  onclick="return confirm('Are you sure ?')" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                                <td><a href="{!!route('product.edit',$item->id)!!}" class="btn btn-success" style="color:white;text-decoration:none;" >Edit</a>  
                                <a class="btn btn-success" href="{!!route('image.show',$item->id)!!}" >Images</a></td>          
                            </tr>
                        
                        @endforeach    
                        </tbody>
                    </table>
               
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        @endsection