var email = user.email;

var socket = io('http://127.0.0.1:3000');
socket.emit('register',user);

 $('#private-form').submit(function(){
 		//var to = $('#user-to').val();
 		var mess = $('#private-mess').val();
 		socket.emit('send private message',currentEmail,mess);

 		return false;
 })

socket.on('receiver private mess',function(data){
	console.log(data);
})

var currentEmail;
$('.list').on("click", "li", function(event){
	$('#user-to').val($(this).text());
	currentEmail = this.id;
});

