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
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Display Name</th>
                                <th>Email</th>
                                <th>Right</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php   
                            $i=1;
                        ?>
                           @foreach($userList as $item)
                            
                   
                            <tr class="odd gradeX" align="center">
                                <td>{!!$i!!}</td>
                                <td>{!!$item->name!!}</td>
                                <td>{!!$item->email!!}</td>
                                <td><?php if($item->level==1){echo "Khách";}else{echo "Quản Trị";} ?></td>
                                <form method="post" action="{{ route('user.destroy',$item->id)}}">
                                <input type="hidden" name="_token" value="{!! csrf_token()!!}"/>
                                <input type="hidden" name="_method" value="DELETE"/>
                                <input type="hidden" name="id" value="{{$item->id}}"/>
                                <td class="center"><button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-danger">Delete</button></td>
                                </form>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('user.edit',$item->id)!!}">Edit</a></td>
                            </tr>
                            <?php
                            $i++;
                            ?>
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