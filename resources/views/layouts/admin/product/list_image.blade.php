@extends('layouts.admin.index')
@section('content')
<!-- Page Content -->
       <div id="page-wrapper" style="min-height: 494px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Image
                            <small>List</small>
                        </h1>
                    </div>
            
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Image</th>
                              
                                <th>Delete</th>
                                
                            </tr>
                        </thead>
                        <tbody>
            
                        @foreach($image_list as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{!!$item->id!!}</td>
                                <td>
                                <img width="150" height="120" src="{{ URL::to('/storage/' . $item->url) }}" alt="" class="img-responsive">
                                </td>
                                
                                <td class="center">
                                        <form method="post" action="{{ route('image.destroy',$item->id)}}"  >
                            <input type="hidden" name="_token" value="{!! csrf_token()!!}"/>
                            <input type="hidden" name="_method" value="DELETE"/>
                            <input type="hidden" name="id" value="{{$item->id}}"/>
                                <button type="submit"  onclick="return confirm('Are you sure ?')" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                                       
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