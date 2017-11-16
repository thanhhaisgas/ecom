
<!DOCTYPE HTML>
<html>
<head>
<title>Website Template </title>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href="{{asset('login/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{asset('bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="all" />
<!-- Latest compiled and minified CSS -->


<!-- Latest compiled and minified JavaScript -->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="{{asset('login/js/jquery.min.js')}}"></script>
<script src="{{asset('login/js/myjs.js')}}" ></script>
<script src="{asset('bootstrap/css/bootstrap.min.js')}}" ></script>
<script src="{{asset('js/md5.min.js')}}" ></script>
</head>
<body>
     <div class="wrapper">
    <form class="form-signin" method="post" id="form_login" action="{!! route('login.store') !!}">

      @if(count($errors)>0)
            <div class="alert alert-danger">
                <strong>Lỗi: </strong><br><br>
                <ul>
                    @foreach($errors->all() as $item)
                        <li>{{$item}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <?php
            if(isset($fail)){
          print_r($fail);
            }

            ?>
	 	<input type='hidden' name='_token' value="{!! csrf_token() !!}" />
        <input type="hidden" name="key" value="{!! $_SESSION['key']=str_random(30) !!}" id="key"/> 
         <input type="hidden"  name="password1" id="password1" />      
      <h2 class="form-signin-heading">Đăng Nhập</h2>
      <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required=""  autofocus="" />
      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="" />  
     
          
      <label class="checkbox">

      </label>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng Nhập</button>   
    </form>
  </div>

</body>
</html>

