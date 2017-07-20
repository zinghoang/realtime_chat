<!DOCTYPE html>
<html>
<head>
	<title>HOME TEST CHAT </title>
</head>
<body>
	<!-- LOGOUT-->
      Welcome :<strong> {{$user->name}}</strong>
     <a href="{{ route('logout') }}" onclick="event.preventDefault();
	document.getElementById('logout-form').submit();"> Logout</a>
	
	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	    {{ csrf_field() }}
	</form>
	<!-- LOGOUT-->
    <h2>List Users</h2>
    <ul class="list">
        @foreach($users as $u)
            <li id="{{$u->email}}"> {{$u->name}}</li>
        @endforeach
    </ul>
    <br>
    
       <h1>SEND PRIVATE CHAT</h1>
        <form action="#"  id="private-form" method="get">
            To : <input type="text" id="user-to">
            <input type="text" id="private-mess">
            <input type="submit" value="Send" id= "send">
        </form>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.js"></script>
<script>
     var user = {!!json_encode($user)!!};

     console.log({!!$users!!});
</script>
<script type="text/javascript" src="js/chat.js"></script>
</html>