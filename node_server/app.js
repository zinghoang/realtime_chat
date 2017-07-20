var server = require('http').Server();
var io = require('socket.io')(server);

server.listen(3000);

var globalConnect = [];	
var count = 0;
var t=0;
io.on('connection',function(socket){
	var currentUser;
	console.log('welcome ' + socket.id);

	// socket.on('join-channel',function(data){
	// 	console.log(data);
	// 	for(i = 0 ; i < data.length; ++i){
	// 		socket.join(data[i]);
	// 		socket.broadcast.to(data[i]).emit('new user join', 'id:' + t +
	// 		 'join room: ' + data[i]);
	// 	}
	// });

	// socket.on('send message',function(room,data){
	// 	console.log(room + ' -  '+ data);
	// 	io.in(room).emit('update chat',"id: "+ socket.id + " - " +"room :" + room + " \n mess: "+data);
	// });

	//--------- PRIVATE CHAT ---------
	socket.on('register',function(data){
		console.log(socket.id + " : " + data.email);
		currentUser = new User(socket,data)
		globalConnect[count++] = currentUser ;
	});

	socket.on('send private message',function(email,message){
		for(temp=0; temp< globalConnect.length;temp++){
			if(globalConnect[temp].user.email == email){
				globalConnect[temp].socket.emit('receiver private mess',currentUser.user.name + " - " + message);
			}
		}
	})

	socket.on('disconnect',function(){
		console.log(socket.id + " has disconnect");
	})
})

//-- Object User
function User(socket,user){
	this.socket = socket;
	this.user = user;
}


