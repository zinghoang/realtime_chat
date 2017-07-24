var server = require('http').Server();
var io = require('socket.io')(server);

server.listen(3000);

var globalConnect = [];	
io.on('connection',function(socket){
	var currentUser;

	socket.on('send room message',function(sender,data){
		console.log(data);
		// io.in('room-'+room.id).emit('receiver room mess', "room :" + room + " \n messeage: "+data);
		socket.broadcast.to('room-'+data.room_id).emit('receiver room mess',sender,data);
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


