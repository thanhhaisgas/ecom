@extends('layouts.admin.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category List
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category Parent</th>
                                <th>Status</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>
                            @foreach($categoriesList as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{!!$item->id!!}</td>
                                <td>{!!$item->name!!}</td>
                                <td>{!!$item->parent_id!!}</td>
                                <td><?php if($item->status==1){echo "Show";}else{echo "Hide";} ?></td>
                                <form method="post" action="{{ route('category.destroy',$item->id)}}">
                                <input type="hidden" name="_token" value="{!! csrf_token()!!}"/>
                                <input type="hidden" name="_method" value="DELETE"/>
                                <input type="hidden" name="id" value="{{$item->id}}"/>
                                <td class="center"><button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-danger">Delete</button></td>
                                </form>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('category.edit',$item->id)!!}">Edit</a></td>
                            </tr>
                            <?php $i++; ?>
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