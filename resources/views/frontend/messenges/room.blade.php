@extends('frontend.layouts.master')

@section('content')

<div class="ms-body">
	<div class="listview lv-message">
		@widget('MessageRoom', ['id' => $room->id], $room->id)
		<div class="lv-body">
			<div class="row content-chat-video">
				@if($isJoin == 1)

			        
				<div class="col-md-7">
				@if($errors->count()>0)
				    	@foreach($errors->all() as $error)
		                    <div class="alert alert-danger" style="margin: 5px 10px 5px 5px;"><p><strong>{{ $error }}</strong></p></div>
		                @endforeach
			        @endif
					<div class="show-video" id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:580px;">
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
									
								<li class="">
									<a href="javascript:void(0)" class="change-video">
										<i class="fa {{ ($file->type=='video') ?'fa-play-circle-o':'fa-volume-up' }}" aria-hidden="true"></i><span class="video-id hidden">
											{{ $file->id }}
										</span>
										<span>
											{{ $file->title }}
										</span>
									</a>
									<em style="color: #cccccc;">- {{ $file->user->fullname }}</em>
								</li>
								@endforeach
								
							</ul>
						</div>
					</div>
					<hr>
				</div>
				<div class="col-md-5 div-chat">
					<div id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:580px;" class="room-contentt">
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
						<textarea rows="10" placeholder="Write messages..." id="mess-content"></textarea>
						<button class="" id="btn-room-reply">
							<span class="glyphicon glyphicon-send"></span>
						</button>
					</div>
				</div>
				@else
				<div class="col-md-12">
					<div class="show-video" id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:580px;">
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

<script>
	var currentRoom = {!!json_encode($room)!!};
	@if($isJoin == 1)
    $('#mess-content').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == 13) {
			$('#btn-room-reply').click();
            $('#mess-content').val('');
        }
    });

    $('.change-video').click(function(){
    	var id = $(this).find('.video-id').html();

    	$.ajax({
			url: "{{ route('frontend.room.changeVideo', $room->id) }}",
			type: 'POST',
			cache: false,
			data: {
				file_id: id,
			},
			success: function(data){

				var vid = document.getElementById("myVideo");
				vid.src = data;

				vid.load();

			},
			error: function (){
				alert('Có lỗi');
			}
		});
    });

    @endif
</script>
@endsection