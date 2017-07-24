var server = require('http').Server();
var io = require('socket.io')(server);

server.listen(3000);

var globalConnect = [];	
io.on('connection',function(socket){
	var currentUser;
	//console.log('welcome ' + socket.id);

	// socket.on('join-channel',function(data){
	// 	console.log(data);
	// 	for(i = 0 ; i < data.length; ++i){
	// 		socket.join(data[i]);
	// 		socket.broadcast.to(data[i]).emit('new user join', 'id:' + t +
	// 		 'join room: ' + data[i]);
	// 	}
	// });

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

	socket.on('join room',function(data){
		console.log('join room: ');
		for(i=0; i<data.length; ++i){
			console.log(data[i]);
			socket.join('room-'+data[i].id);
		}
	});

	//--------- PRIVATE CHAT ---------
	socket.on('register',function(data){
		currentUser = new User(socket,data);
		globalConnect.push(currentUser) ;
	});

	socket.on('send private message',function(message){

		for(temp=0; temp< globalConnect.length;temp++){
			if(globalConnect[temp].user.id == message.to){
				console.log(message);
				globalConnect[temp].socket.emit('receiver private mess',message);
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
function User(socket,user){
	this.socket = socket;
	this.user = user;
}


