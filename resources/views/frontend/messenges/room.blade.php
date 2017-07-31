@extends('frontend.layouts.master')

@section('content')

<div class="ms-body">
	<div class="listview lv-message">
		@widget('MessageRoom', ['id' => $room->id], $room->id)
		<div class="lv-body">
			<div class="row content-chat-video">
				@if($isJoin == 1)
			        
				<div class="col-md-7" style="border-bottom: 1px solid #cccccc;">
					<div class="show-video" id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:80vh;">
						<div class="content-video">
							@if(count($listFile) == 0)
								<div style="font-size: 350px; color: #cccccc; text-align: center;">
									<form method="post" action="{{ route('frontend.message.uploadfile', $room->id) }}" enctype="multipart/form-data" id="choose-file">
										{{ csrf_field() }}
										<label for="choose">
											<i class="fa fa-upload" aria-hidden="true"></i> 
											<input type="file" id="choose" name="title" style="display:none" onchange="event.preventDefault(); document.getElementById('choose-file').submit();">
										</label>
								    </form>
							    </div>
							@else

								<video width="100%" controls class="video-play" id="myVideo">
									<source src="{{ asset('storage/media/' . $listFile[0]->name) }}" type="video/mp4">
									Your browser does not support HTML5 video.
								</video>
							@endif
						</div>
						<div class="list-video">

							<ul class="show-list-video" style="list-style: none;">
								@foreach ($listFile as $key => $file)
									
								<li class="" id="{{ $file->id }}">
									<a href="javascript:void(0)" class="change-video" >
										<i class="fa {{ ($file->type=='video') ?'fa-play-circle-o':'fa-volume-up' }}" aria-hidden="true"></i><span class="video-id hidden">
											{{ $file->id }}
										</span>
										<span>
											{{ str_limit($file->title, 40) }}
										</span>
									</a>
									<em>- {{ str_limit($file->user->fullname, 20) }}</em>
									@if($file->user_id == Auth::id() || $room->user_id == Auth::id())
										<a href="{{ route('frontend.message.deletefile', $file->id) }}" onclick="event.preventDefault(); document.getElementById('deletefile-form').submit();" style="text-decoration: none;">
											<span class="glyphicon glyphicon-trash"></span>
										</a>

										<form id="deletefile-form" action="{{ route('frontend.message.deletefile', $file->id) }}" method="POST" style="display: none;">
							                {{ csrf_field() }}
							                <input type="hidden" name="_method" value="DELETE">
							            </form>
									@endif
								</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-5 div-chat">
					<div id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:72vh;" class="room-contentt" onmouseenter="return deleteNotifRoom({{ $room->id }},{{ Auth::user() }})">
						@if($messages->count()>0)
							@foreach($messages as $message)
								@if($message->status == 0)
									<div style="padding-left: 30px;">	
										<h6>
											<em style="color: #cccccc;">
												{!! $message->content !!}
											</em>
										</h6>
									</div>
								@else
									<div class="lv-item media @if($message->user_id == Auth::id()) right @else left @endif">
										<div class="lv-avatar @if($message->user_id == Auth::id()) pull-right @else pull-left @endif">
											<img src="{{ url('../storage/avatars/',$message->avatar) }}" alt="">
										</div>
										<div class="media-body">
											<div class="ms-item">
												{!! $message->content !!}
											</div>
											<small class="ms-date">
												@if($message->name != Auth::user()->name)
													<a href="{{ route('private.user', $message->name) }}">
														<strong style="font-size: 10px">{{ $message->fullname }}</strong>
													</a>
													@if($message->user_id == $room->user_id)
														- <strong style="color: red;font-size: 10px">[AD]</strong>
													@endif
												@endif
												<span class="glyphicon glyphicon-time"></span>
												&nbsp; {{ $message->created_at }}
											</small>
										</div>
									</div>
								@endif
							@endforeach
						@endif
					</div>
					<div class="clearfix"></div>
					<div class="lv-footer ms-reply">
						<textarea rows="10" placeholder="Write messages..." id="mess-content" onclick="return deleteNotifRoom({{ $room->id }},{{ Auth::user() }})"></textarea>
						<button class="" id="btn-room-reply">
							<span class="glyphicon glyphicon-send"></span>
						</button>
					</div>
				</div>
				@else
				<div class="col-md-12">
					<div class="show-video" id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:530px;">
	                    <div class="border text-center">
	                        <a href="{{ route('frontend.room.join', $room->id) }}" style="font-size: 340px; color: #cccccc;">
	                            <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
	                        </a>
	                        <h5><a id="join" href="{{ route('frontend.room.join', $room->id) }}" >CLICK HERE TO JOIN THIS ROOM</a></h5>
	                    </div>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection

@section('script2')
<script type="text/javascript">
	var currentRoom = {!!json_encode($room)!!};
</script>
@endsection

@section('endscript')
<script>
	index = 10;
    scroll('.room-contentt');
	@if($isJoin == 1)
    $('#mess-content').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == 13) {
			$('#btn-room-reply').click();
            $('#mess-content').val('');
        }
    });

    function changeVideo(id){
    	$.ajax({
			url: "{{ route('frontend.room.changeVideo', $room->id) }}",
			type: 'POST',
			cache: false,
			data: {
				file_id: id,
			},
			success: function(data){
				
				var video = $('#myVideo')[0];
				$("#myVideo source").attr("src",data)
				video.load();
				socket.emit('send action','video',currentRoom,data,'load');
			},
			error: function (){
			}
		});
    }
    $('.change-video').click(function(){
		var id = $(this).find('.video-id').html();
    	changeVideo(id);
    });

    $('#myVideo').bind('play', function () {
   		//whatever you want to do
   		socket.emit('send action','video',currentRoom,null,'play');
	});
	$('#myVideo').bind('pause', function () {
   		//whatever you want to do
   		socket.emit('send action','video',currentRoom,null,'pause');
	});
	
    socket.on('receiver action',function(type,room,action,data){
    	var vid = $('#myVideo')[0];
    	if(currentRoom.id == room.id){
    		if( action == 'load'){
				console.log(data);
				$("#myVideo source").attr("src",data)
				vid.load();
	    	} else if ( action == 'play') {
	    		vid.play();
	    	} else if ( action == "pause") {
	    		vid.pause();
	    	} else if ( action == "uploaded") {
	    		//add video div if list file is empty
	    		var count = {!!count($listFile)!!};
	    		if(count == 0){
	    			$(".content-video").html('<video width="100%" controls class="video-play" id="myVideo"> <source src="" type="video/mp4"> Your browser does not support HTML5 video. </video>')
	    		}
	    		//add message
       			$('.room-contentt').append('<div style="padding-left: 30px;">'
                            +'<h6>'+'<em style="color: #cccccc;">'+data[3]+'</em>'+'<h6>'+'</div>');
	    		//add to video list
	    		var videoDiv = '<li class=""> <a href="javascript:void(0)" class="change-video"> <i class="fa fa-play-circle-o" aria-hidden="true"></i><span class="video-id hidden">'+ data[0] + '</span> <span>'+ data[1] + '</span> </a> <em>- '+ data[4] +'</em> </li>';

	    		$('.show-list-video').append(function(){
	    			return $(videoDiv).click(function(){
	    				changeVideo(data[0]);
	    			});
	    		});

	    	} else if ( action == 'file-deleted'){
	    		//add delete message
       			$('.room-contentt').append('<div style="padding-left: 30px;">'+'<h6>'+'<em style="color: #cccccc;">'+data[3]+'</em>'+'<h6>'+'</div>'); 
       			//remove li
       			var li = '#'+data[0]; 
       			$(li).remove();
       		}
    	}
    });

    function deleteNotifRoom(roomid,userid) {
        $.ajax({
            url : "{{ route('deleteNotifRoom') }}",
            type : "post",
            dataType:"text",
            data : {
                'roomid' : roomid,
                'userid' : userid
            },
            success : function (result){
            },error: function (){
            }
        });
    }
    @endif
	$(function(){
        $('.room-contentt').scroll(function(){
            var distance = $('.room-contentt').scrollTop();
            if(distance == 0){
                $.ajax({
                    url : "{{ route('getmoreMsgRoom') }}",
                    type : "post",
                    dataType:"text",
                    data : {
                        'roomid' : {{ $room->id  }},
                        'offset': index
                    },
                    success : function (result){
                        if(result != 0){
                    		
                            $('.room-contentt').prepend(result);
                            distance = $('.room-contentt').scrollTop(500);
						}
                    },error: function (){
                    }
                });
                index = index + 10;
            }
        });
    });
    @if(Session::has('fileUpload'))
		var str = "{!!Session::get('fileUpload') !!}";
		var fileInfor = str.split("|");
		//send to other that file is uploaded
		socket.emit('send room message','file uploaded',currentRoom,fileInfor);
    @endif
    @if(Session::has('fileDelete'))
    	var str = "{!!Session::get('fileDelete')!!}";
    	var fileInfor = str.split("|");
    	socket.emit('send room message','file deleted',currentRoom,fileInfor);
    @endif

</script>

@if($isJoin == 1)
<script src="{{ asset('js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/validate.js') }}" type="text/javascript"></script>

@endif
@endsection

@if(Session::has('success'))
    @section('scriptAlert')
    <script type="text/javascript">
        notes.show("{{ Session::get('success') }}", {
            type: 'success',
            title: 'Success',
            icon: '<i class="icon icon-check-sign"></i>'
        });
    </script>
    @endsection
@endif

@if(Session::has('danger'))
    @section('scriptAlert')
    <script type="text/javascript">
        notes.show("{{ Session::get('danger') }}", {
            type: 'danger',
            title: 'Error',
            icon: '<i class="icon icon-exclamation-sign"></i>'
        });
    </script>
    @endsection
@endif