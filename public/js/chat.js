//user , toUser, currentRoom

var socket = io('http://127.0.0.1:3000');
socket.emit('register',user);

//Join room
socket.emit('join room',roomJoined);

socket.on('receiver private mess',function(data){
	console.log(data);

	// chat 2 nguoi
	
    var mydate = new Date(data.created_at);

    var dateFormat = mydate.getDate() + '-' + mydate.getMonth() + '-' + mydate.getFullYear() + ' at ' +
    	            mydate.getHours() + ":" + mydate.getMinutes() + ":" + mydate.getSeconds();

    var stringDivData = ' <div class="lv-item media"> ' + ' <div class="lv-avatar pull-left"> ' +
    	  	' <img src="../storage/avatars/'+ toUser.avatar +'" alt=""> ' + ' </div> ' + ' <div class="media-body"> ' +
    	  	' <div class="ms-item"> ' + data.content + ' </div> ' + ' <small class="ms-date"> ' +
    	  	' <span class="glyphicon glyphicon-time"></span> ' + ' &nbsp; ' + dateFormat + ' </small> ' + ' </div> ' + ' </div> ' ;

    $('.content-message').append(stringDivData);
})

//Send private message 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
if($("#btn-reply").length){
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
		  	' <img src="../storage/avatars/'+ user.avatar +'" alt=""> ' + ' </div> ' + ' <div class="media-body"> ' +
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
} 

//Send room message
if($('#btn-room-reply').length){
	$('#btn-room-reply').click(function(){
		var message = $('#mess-content').val();

		//add to database
		var request = $.ajax({
			type: "post",
			url: '/message/add-room-message',
			data: {'user': user,
				'room': currentRoom,
				'message': message
			}
		});

		request.done(function (response, textStatus, jqXHR){
		  	console.log(response);
			
			var mydate = new Date(response.created_at);

            var dateFormat = mydate.getDate() + '-' + mydate.getMonth() + '-' + mydate.getFullYear() + ' at ' +
            		  	mydate.getHours() + ":" + mydate.getMinutes() + ":" + mydate.getSeconds();


            var stringDivData = ' <div class="lv-item media right"> '+' <div class="lv-avatar pull-right"> '
            +' <img src="../../storage/avatars/'+response.avatar +'" alt=""> '
            +' </div> '+' <div class="media-body"> '+' <div class="ms-item"> '+response.content+' </div> '+' <small class="ms-date"> '
            +' <span class="glyphicon glyphicon-time"> '+' </span> '+' &nbsp; ' +dateFormat
            +' </small> '+' </div> '+' </div> ';
            $('.room-contentt').append(stringDivData);

            socket.emit('send room message','message',user,response);
		});

		// Callback handler that will be called on failure
		request.fail(function (jqXHR, textStatus, errorThrown){
			console.error("error");
		});

		$('#mess-content').val('');
	})
}
//Join Event
if($('#join').length){
	$('#join').click(function(){
		//Send join event to others
		socket.emit('send room message','register-room',user,currentRoom);
	})
}
//Leave Event
if($('#leave-room').length){
	$('#leave-room').click(function(){
		//send leave event to others
		socket.emit('send room message','leave-room',user,currentRoom);
	});
}

//Receiver message from server
socket.on('receiver room mess',function(type,sender,data){
	if(type == 'message'){
		console.log(data);
		//chat room
		var mydate = new Date(data.created_at);

	    var dateFormat = mydate.getDate() + '-' + mydate.getMonth() + '-' + mydate.getFullYear() + ' at ' +
	        	            mydate.getHours() + ":" + mydate.getMinutes() + ":" + mydate.getSeconds();

	    var stringDivData = ' <div class="lv-item media left"> '+' <div class="lv-avatar pull-left"> '
	                +' <img src="../../storage/avatars/'+data.avatar +'" alt=""> '
	                +' </div> '+' <div class="media-body"> '+' <div class="ms-item"> '+data.content+' </div> '+' <small class="ms-date"> '
	                +' <span class="glyphicon glyphicon-time"> '+' </span> '+' &nbsp; ' +dateFormat
	                +' </small> '+' </div> '+' </div> ';

	    $('.room-contentt').append(stringDivData);
	} else if ( type == 'notif') {
		console.log(sender);
		console.log(data); //join - leave
		console.log(type);
	} else if ( type == 'notif-join') {
		alert(data);
	}
})

if($('#invite-form').length){
	$('#invite-form').submit(function(){
		var room_id = $('#room_id').val();
		var username = $('#name-search').val();
		
		$.ajax({
			type: "GET",
			url: '/inviteUser',
			data: {
				'username': username,
				'room_id' : room_id
			},
			success: function(data){
				if(data['status'] == 'success'){
					console.log(data['user']);
					socket.emit('invite to room',user,data['user'],data['room']);
					$('#message-form').html('<div class="alert alert-success"> <strong>Success!</strong> Invite Success. </div>');
					$('#name-search').val('');
				} else {
					$('#message-form').html('<div class="alert alert-danger"> <strong>Danger!</strong> Invalid Username. </div>')
				}
				$('#message-form').fadeIn('slow', function () {
			   		 $(this).delay(3000).fadeOut('slow');
			 	 });
			}
		});
	});
}