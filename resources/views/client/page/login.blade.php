@extends('client.layouts.index')
@section('content')

<div class="container">
		<div class="account">
		<h1>Account</h1>
		<div class="account-pass">
		<div class="col-md-8 account-top">
			<form class="form-signin" method="post" id="form_login" action="{!! route('login_user.store') !!}">
				  @if(count($errors)>0)
            <div class="alert alert-danger">
              
                
                    @foreach($errors->all() as $item)
                      {!!$item!!} <br>
                    @endforeach
                </ul>
            </div>
            @endif
			@if(session()->has('errorlogin'))
				<div class="alert alert-danger">{!!session()->get('errorlogin')!!}</div>
			@endif
      
	 	<input type='hidden' name='_token' value="{!! csrf_token() !!}" />
        <input type="hidden" name="key" value="{!! $_SESSION['key']=str_random(30) !!}" id="key"/> 
         <input type="hidden"  name="password1" id="password1" />  
			<div> 	
				<span>Email</span>
				<input type="text" name="email" id="email" > 
			</div>
			<div> 
				<span>Password</span>
				<input type="password" name="password" id="password">
			</div>				
				<input type="submit" value="Login"  > 
			</form>
		</div>
		<div class="col-md-4 left-account ">
			<a href="single.html"><img class="img-responsive " src="images/s1.jpg" alt=""></a>
			<div class="five">
			<h2>25% </h2><span>discount</span>
			</div>
			<a href="register.html" class="create">Create an account</a>
<div class="clearfix"> </div>
		</div>
	<div class="clearfix"> </div>
	</div>
	</div>

</div>
@endsection