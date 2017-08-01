//user , toUser, currentRoom

var socket = io('http://127.0.0.1:3000');

if(typeof currentRoom !== 'undefined' && isJoin){
	//register user and current room
	socket.emit('register',user,currentRoom);
} else {
	//register user
	socket.emit('register',user,null);
}

//Join room
socket.emit('join room',roomJoined);

socket.on('receiver private mess',function(type,data){
	// chat 2 nguoi
	if(type == 'message'){
	    var mydate = new Date(data.created_at);

    var dateFormat = mydate.getDate() + '-' + mydate.getMonth() + '-' + mydate.getFullYear() + ' at ' +
    	            mydate.getHours() + ":" + mydate.getMinutes() + ":" + mydate.getSeconds();
    if(typeof toUser !== 'undefined'){
        if(parseInt(data.from) == toUser.id){
            var stringDivData = ' <div class="lv-item media"> ' + ' <div class="lv-avatar pull-left"> ' +
                    ' <img src="../storage/avatars/'+ toUser.avatar +'" alt=""> ' + ' </div> ' + ' <div class="media-body"> ' +
                    ' <div class="ms-item"> ' + data.content + ' </div> ' + ' <small class="ms-date"> ' +
                    ' <span class="glyphicon glyphicon-time"></span> ' + ' &nbsp; ' + dateFormat + ' </small> ' + ' </div> ' + ' </div> ' ;
            $('.content-message').append(stringDivData);
            if($('.content-message').length){
               scroll('.content-message');
            }
        }
    }


    //cap nhat listUser
    var pathname = window.location.pathname;
        var arr_name = pathname.split('/');
        var name = arr_name[arr_name.length-1];
    var stringDivUser = '';
    for(var i = 0; i< data.listUser.length;i++){
        stringDivUser = stringDivUser + '<div class="lv-item media">'
                            +'<div class="lv-avatar pull-left">'
                            +'<img src="/storage/avatars/'+ data.listUser[i].avatar+'" alt="">'
                            +'</div>'
                            +'<div class="media-body">'
                            +'<div class="lv-title">'
                            +'<a href="/chat/'+data.listUser[i].name+'" title="" style="text-decoration:none;">'
                            + data.listUser[i].fullname
                            +'</a>';
        if(data.listUser[i].notif == 1 && data.listUser[i].name != name){
            stringDivUser = stringDivUser + '<i class="fa fa-star" aria-hidden="true" style="color: #aa1111"></i>';
        }
        stringDivUser = stringDivUser + '</div>'
        +'<div class="lv-small">'+'@ '+data.listUser[i].name
        +'</div>'
        +'</div>'
        +'</div>';
    }
    stringDivUser = stringDivUser + ' <div class="lv-item media">'
                                     		+'<div class="media-body">'
                                     			+'<p class="text-center" style="margin: 0px;">'
                                     				+'<a href="/chat" title="" style="text-decoration:none;">'
                                     					+'Show All Contacts'
                                     				+'</a>'
                                     			+'</p>'
                                     		+'</div>'
                                     	+'</div>';
     $('.listUser').html(stringDivUser);

	} else if( type =='room infor'){
		console.log(type);
		console.log(data);
		
		var video = $('#myVideo')[0];
		$("#myVideo source").attr("src",data.src);
		video.load();
		video.currentTime = data.currentTime;
		if(!data.paused){
			video.play(); 
		}
	}
	

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
				'message': mess,
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
            if($('.content-message').length){
                scroll('.content-message');
            }

            //cap nhat listUser
                var pathname = window.location.pathname;
                    var arr_name = pathname.split('/');
                    var name = arr_name[arr_name.length-1];
                var stringDivUser = '';
                for(var i = 0; i< response.listUserFrom.length;i++){
                    stringDivUser = stringDivUser + '<div class="lv-item media">'
                                        +'<div class="lv-avatar pull-left">'
                                        +'<img src="/storage/avatars/'+ response.listUserFrom[i].avatar+'" alt="">'
                                        +'</div>'
                                        +'<div class="media-body">'
                                        +'<div class="lv-title">'
                                        +'<a href="/chat/'+response.listUserFrom[i].name+'" title="" style="text-decoration:none;">'
                                        + response.listUserFrom[i].fullname
                                        +'</a>';
                    stringDivUser = stringDivUser + '</div>'
                    +'<div class="lv-small">'+'@ '+response.listUserFrom[i].name
                    +'</div>'
                    +'</div>'
                    +'</div>';
                }
                stringDivUser = stringDivUser + ' <div class="lv-item media">'
                                                 		+'<div class="media-body">'
                                                 			+'<p class="text-center" style="margin: 0px;">'
                                                 				+'<a href="/chat" title="" style="text-decoration:none;">'
                                                 					+'Show All Contacts'
                                                 				+'</a>'
                                                 			+'</p>'
                                                 		+'</div>'
                                                 	+'</div>';
                 $('.listUser').html(stringDivUser);


		  	socket.emit('send private message','message',response);
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
            if($('.room-contentt').length){
                scroll('.room-contentt');
            }
            //cap nhat listRoom
            	    var stringDivRooms = '';
            	    for( var i=0;i<response.roomsFrom.length;i++){
                        if(i==0){
                            stringDivRooms = stringDivRooms + ' <div class="lv-item media active"> '
                        }else{
                            stringDivRooms = stringDivRooms + ' <div class="lv-item media"> '
                        }
            	        stringDivRooms = stringDivRooms +' <div class="lv-avatar pull-left"> '
            	                                                    +' <img src="../../images/home.png" alt=""> '
            	                                                +' </div> '
                                                           		+' <div class="media-body"> '
                                                           			+' <div class="lv-title"> '
                                                           			+' <a href="/message/room/'+response.roomsFrom[i].id+'" title="" style="text-decoration:none;"> '
                                                           			+ response.roomsFrom[i].name
                                                           			+' </a> ';
                        if(response.roomsFrom[i].notif == 1){
                            stringDivRooms = stringDivRooms + ' <i class="fa fa-star" aria-hidden="true" style="color: #aa1111"></i> ';
                        }
                        stringDivRooms = stringDivRooms + '</div>'
                                                           			+' <div class="lv-small"> Click here to chat... </div> '
                                                           		+' </div> '
                                                           +' </div> ';
            	    }
            	    stringDivRooms = stringDivRooms + ' <div class="lv-item media"> '
            	                                        +' <div class="media-body"> '
            	                                            +' <p class="text-center" style="margin: 0px;"> '
            	                                                +' <a href="/room" title="" style="text-decoration:none;"> '
            	                                                    +'SHOW ALL ROOMS';
                    if(response.moreNotif > 0){
                        stringDivRooms = stringDivRooms + '<span style="color: #aa1111">[ '+response.moreNotif+' ]</span>';
                    }
                    stringDivRooms = stringDivRooms +' </a> </p> </div></div> ';
                    $('.listRoom').html(stringDivRooms);


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
 		var result = confirm("Do you want to leave this room?");
		if (result) {
		   	//send leave event to others
			socket.emit('send room message','leave-room',user,currentRoom);
		} else return false;
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
	                +'<a href="/chat/'+data.username+'"><strong style="font-size: 10px">'+data.fullname+'</strong></a>';

        if(data.room_userid == data.user_id){
            stringDivData = stringDivData + '- <strong style="color: red;font-size: 10px">[AD]</strong>';
        }

	    stringDivData = stringDivData + ' <span class="glyphicon glyphicon-time"> '+' </span> '+' &nbsp; ' +dateFormat
	                                  +' </small></div></div> ';

	    $('.room-contentt').append(stringDivData);
	    if($('.room-contentt').length){
            scroll('.room-contentt');
	    }
        $.ajax({
             url : "/room/reloadListRoom",
             type : "post",
              dataType:"text",
              data : {

              },
              success : function (result){
                  $('.listRoom').html(result);
              },
              error: function () {
                  alert("Error");
              }
        });

	} else if ( type == 'notif') {
		console.log(sender);
		console.log(data); //join - leave
		console.log(type);
        var stringDivData = '<div style="padding-left: 30px;">'
                            +'<h6>'+'<em style="color: #cccccc;">'+data+'</em>'+'<h6>'+'</div>';
        $('.room-contentt').append(stringDivData);
        var count = parseInt($('.countmember').text());
        if(data.search("join")>=0){
            count = count+1;
        }else{
            count = count-1;
        }
        $('.countmember').text(count);
	} else if ( type == 'notif-join') {
		alert(data);
	} else if (type == 'get room infor') {
		 var video = $('#myVideo')[0];
		 var data = null;
		 if(typeof video !== 'undefined'){
		 	data = new Object;
		 	data.sender = sender;
			data.src = $("#myVideo source").attr("src");
		 	data.paused = video.paused;
		 	data.currentTime = video.currentTime; 
		 }
		 //send back status of room to user
		socket.emit('send private message','room infor',data);
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

function scroll(element) {
    $(element).animate({
            scrollTop: $(element)[0].scrollHeight
    });
}
