// var email = user.email;

var socket = io('http://127.0.0.1:3000');
socket.emit('register',user);

socket.on('receiver private mess',function(data){
	console.log(data);
	//nhan ve, giong respon
})

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#btn-reply').click(function(){
	var mess = $('#txt-mess-content').val();
  	
  	$('#txt-mess-content').val('');



	var request = $.ajax({
		type: "post",
		url: '/chat/addprivatemess',
		data: {'user': user,
			'toUser': toUser,
			'message': mess
		}
	});

	request.done(function (response, textStatus, jqXHR){
	  	console.log(response);

	  	var mydate = new Date(response.created_at);

	  	var dateFormat = mydate.getDate() + '-' + mydate.getMonth() + '-' + mydate.getFullYear() + ' at ' + 
	  	mydate.getHours() + ":" + mydate.getMinutes() + ":" + mydate.getSeconds();


	  	var stringDivData = ' <div class="lv-item media right"> ' + ' <div class="lv-avatar pull-right"> ' + 
	  	' <img src="a" alt=""> ' + ' </div> ' + ' <div class="media-body"> ' + 
	  	' <div class="ms-item"> ' + response.content + ' </div> ' + ' <small class="ms-date"> ' + 
	  	' <span class="glyphicon glyphicon-time"></span> ' + ' &nbsp; ' + dateFormat + ' </small> ' + ' </div> ' + ' </div> ' ;
		



		$('.content-message').append(stringDivData);

	  	socket.emit('send private message',response);
	});

	// Callback handler that will be called on failure
	request.fail(function (jqXHR, textStatus, errorThrown){
		console.error("error");
	});
})