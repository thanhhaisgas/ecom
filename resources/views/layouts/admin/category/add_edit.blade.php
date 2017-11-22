@extends('layouts.admin.index')
@section('content')
	<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> <?php echo($name) ?> Category
                        
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
                    @if($action==0)
                        <form method="POST" id="form_editCategory" action="{!! route('category.store') !!}">
                           <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                            <div class="form-group">
                                <label>Category name</label>
                                <input class="form-control" type="text"  name="categoryname" id="categoryname" placeholder="Please Enter Category Name" />
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <br>
                                <label class="radio-inline">
                                    <input type="radio" checked="checked" name="cbStatus" value="1"/> Show
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="cbStatus" value="0"/> Hide
                                </label>
                            </div>
                            <div class="form-group">      
                            <label>Select category's parent:</label>                              
	                            <select class="form-control" name="categoryParent" style="width: auto;">
	                            	<option value=-1>None</option>
	                            	@foreach($categories as $item) 
										    <option value={!!$item->id!!}>{!!$item->name!!}</option>
									@endforeach	
								</select>							
							</div>
                            <button type="submit" class="btn btn-default"><?php echo($name) ?></button>
                        <form>
                    @else
                    	<form method="POST" action="{!! route('category.update', $item->id) !!}">
                           <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                           <?php
                           	$_SESSION["idItem"] = $item->id; 
                           ?>
                           {{ method_field("PUT") }}
                            <div class="form-group">
                                <label>Category name</label>
                                <input class="form-control" type="text"  name="categoryname" id="categoryname" value={!!$item->name!!} />
                            </div>                            
                            <div class="form-group">
                                <label>Status</label>
                                @if($item->status=1)
                                <br>
                                <label class="radio-inline">
                                    <input type="radio" checked="checked" name="cbStatus" value="1"/> Show
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="cbStatus" value="0"/> Hide
                                </label>
                                @else
                                <br>
                                <label class="radio-inline">
                                    <input type="radio" name="cbStatus" value="1"/> Show
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" checked="checked" name="cbStatus" value="0"/> Hide
                                </label>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Current parent of category: <?php echo($item->parent_id);?></label>
                            </div>
                            <div class="form-group">      
                            <label>Select new category's parent:</label>                              
	                            <select class="form-control" name="categoryParent" style="width: auto;">
	                            	<option value=-1>None</option>
	                            	@foreach($categories as $category) 
										    <option value={!!$category->id!!}>{!!$category->name!!}</option>
									@endforeach	
								</select>							
							</div>
                            <button type="submit" class="btn btn-default"><?php echo($name) ?></button>
                        <form>
                    @endif
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection