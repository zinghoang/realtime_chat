var server = require('http').Server();
var io = require('socket.io')(server);

server.listen(3000);

var globalConnect = [];	
io.on('connection',function(socket){
	var currentUser;

	socket.on('send room message',function(type,sender,data){
		if(type == 'message'){
			//send message to other
			socket.broadcast.to('room-'+data.room_id).emit('receiver room mess','message',sender,data);
		} else if (type == 'register-room') {
			//send notification to other that sender has joined
			socket.join('room-'+data.id);
		//	io.in('room-'+data.id).emit('receiver room mess','notif',sender,sender.name + ' has joined this room
			socket.broadcast.to('room-'+data.id).emit('receiver room mess','notif',sender,sender.name + ' has joined this room');

		} else if(type == 'leave-room') {
			socket.broadcast.to('room-'+data.id).emit('receiver room mess','notif',sender,sender.name + ' has left this room');
			socket.leave('room-'+data.id);
		}
	
	});

	//join to list rooms
	socket.on('join room',function(data){
		console.log('join room: ');
		for(i=0; i<data.length; ++i){
			console.log(data[i]);
			socket.join('room-'+data[i].id);
		}
	});

	socket.on('send action',function(type,currentRoom,data,action){
		if(action == 'load'){
			socket.broadcast.to('room-'+currentRoom.id).emit('receiver action',type,currentRoom,action,data);
		} else if (action == 'play') {
			socket.broadcast.to('room-'+currentRoom.id).emit('receiver action',type,currentRoom,action,data);
		} else if (action == 'pause') {
			socket.broadcast.to('room-'+currentRoom.id).emit('receiver action',type,currentRoom,action,data);
		} 
	});

	//Invite User Join Room
	socket.on('invite to room',function(user,userInvite,room){
		//send join message to others 
		io.in('room-'+room.id).emit('receiver room mess','notif',user,userInvite.name + ' has joined this room');
	
		//send notification to user if online
		for(temp=0; temp< globalConnect.length;temp++){
			if(globalConnect[temp].user.id == userInvite.id){
				globalConnect[temp].socket.emit('receiver room mess','notif-join',user,user.name + ' added you to ' + room.name);
			}
		}
	});

	
	socket.on('register',function(user,currentRoom){
		if(currentRoom){
			console.log('current room: ');
			console.log(currentRoom);
			currentUser = new User(socket,user,currentRoom.id);
			sendInfor(user,currentRoom);

		} else {
			currentUser = new User(socket,user,-1);
		}
		globalConnect.push(currentUser) ;
	});

	//--------- PRIVATE CHAT ---------
	socket.on('send private message',function(type,message){
		if(type == 'message'){
			for(temp=0; temp< globalConnect.length;temp++){
				if(globalConnect[temp].user.id == message.to){
					console.log(message);
					globalConnect[temp].socket.emit('receiver private mess',type,message);
				}
			}
		} else if (type == 'room infor'){
			if(message != null){
				var index = globalConnect.findIndex(obj =>obj.user.id == message.sender.id);
				if(index>=0){
					globalConnect[index].socket.emit('receiver private mess',type,message);
				}
			}
		}
	})

	socket.on('disconnect',function(){
		console.log(socket.id + " has disconnect");
		var index = globalConnect.indexOf(currentUser);
		console.log('disconect index ' + index);
		if(index>=0){
			globalConnect.splice(index,1);
		}
	})
})

//-- Object User
function User(socket,user,current){
	this.socket = socket;
	this.user = user;
	this.current = current;
}


/*get information of this room
* server send message that user in room to receiver infor
*/
function sendInfor(user,room){
	var index = globalConnect.findIndex(obj =>obj.current == room.id);
	if(index >=0){
		globalConnect[index].socket.emit('receiver room mess','get room infor',user,null);
	}
}