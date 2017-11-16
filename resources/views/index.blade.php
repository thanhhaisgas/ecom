
<!DOCTYPE HTML>
<html>
<head>
<title>Website Template </title>


<link href="{{asset('bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css"  />
<!-- Latest compiled and minified CSS -->


<!-- Latest compiled and minified JavaScript -->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

<script src="{{asset('login/js/jquery.min.js')}}"></script>
<script src="{{asset('login/js/myjs.js')}}" ></script>

<script src="{{asset('js/md5.min.js')}}" ></script>
</head>
<body>
 <div class="wrapper">
    @if(session()->has('login'))
       {!! session()->get('login')->email !!}
           <br>
    <a href="logout">Logout</a>
    @else

  Chua login
  @endif
  </div>

</body>
</html>