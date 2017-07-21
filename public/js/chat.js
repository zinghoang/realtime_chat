// var email = user.email;

var socket = io('http://127.0.0.1:3000');
socket.emit('register',user);

socket.on('receiver private mess',function(data){
	console.log(data);
})

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
$('#btn-reply').click(function(){
	var mess = $('#txt-mess-content').val();
  	socket.emit('send private message',toUser.email,mess);
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
	});

	// Callback handler that will be called on failure
	request.fail(function (jqXHR, textStatus, errorThrown){
	console.error("error");
	});
})