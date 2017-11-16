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
                        <form method="POST" action="{!! route('user.store') !!}">
                           <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                            <div class="form-group">
                                <label>Display name</label>
                                <input class="form-control" type="text" value="{!! $user->name!!}"  name="displayname" id="displayname" placeholder="Please Enter Display Name" />
                            </div>
                  
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control"  type="password" value="{!! $decrypted!!}"   name="password" placeholder="Please Enter Password" />
                            </div>
                     
                            <div class="form-group">
                            @if($user->level==2)
                                    <label>Right</label>
                                <label class="radio-inline">
                                    <input name="cbright" value="1"    type="radio"/>Guest
                                </label>
                                <label class="radio-inline">
                                    <input name="cbright" value="2" checked=""   type="radio">Admin
                                </label>
                            @else
                                  <label>Right</label>
                                <label class="radio-inline">
                                    <input name="cbright" value="1" checked=""   type="radio"/>Guest
                                </label>
                                <label class="radio-inline">
                                    <input name="cbright" value="2"    type="radio">Admin
                                </label>
                            @endif
                            
                            </div>
                            <button type="submit" class="btn btn-default">Edit</button>
                
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
          @endsection