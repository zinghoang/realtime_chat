@extends('frontend.layouts.master')

@section('content')

<div class="ms-body">
	<div class="listview lv-message">
		<div class="lv-header-alt clearfix">
			<div id="ms-menu-trigger">
				<div class="line-wrap">
					<div class="line top"></div>
					<div class="line center"></div>
					<div class="line bottom"></div>
				</div>
			</div>
			<div class="lvh-label hidden-xs">
				<div class="lv-avatar pull-left"> 
					<img src="{{ asset('images/home.png') }}" alt=""> 
				</div>
				<span class="c-black">{{ $room->name }}</span>
				@if($isJoin == 1)
				<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" title="Edit the name of room"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

				<!-- Modal -->
	            <div class="modal fade" id="myModal" role="dialog">
	            	<div class="modal-dialog">
	            		<!-- Modal content-->
	            		<div class="modal-content">
	            			<div class="modal-header">
	            				<button type="button" class="close" data-dismiss="modal">&times;</button>
	            				<h4 class="modal-title">Edit name room...</h4>
	            			</div>
	            			<form method="post" action="{{ route('frontend.room.update', $room->id) }}">
	            				{{ csrf_field() }}
	            				<input type="hidden" name="_method" value="PUT">
	            				<div class="modal-body">
	            					<div class="form-group">
		            					<label for="name">Name:</label>
		            					<input type="text" class="form-control" name="name" id="name" value="{{ $room->name }}">
	            					</div>
		            			</div>
		            			<div class="modal-footer">
		            				<button type="submit" class="btn btn-info">Save</button>
		            				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		            			</div>
	            			</form>
	            		</div>
	            	</div>
	            </div>
	            @endif
			</div>
			@if($isJoin == 1)
			<ul class="lv-actions actions list-unstyled list-inline">
				<li>
					<a href="{{ route('frontend.room.leave', $room->id) }}" title="Leave this room"> <i class="fa fa-share" aria-hidden="true"></i> </a>
				</li>
				<li>
					<a href="#">
						<i class="fa fa-upload" aria-hidden="true"></i> 
					</a>
				</li>
				<li>
					<a href="#" title="Invite friend">
						<i class="fa fa-envelope" aria-hidden="true"></i>
					</a>
				</li>

				<li>
					<a data-toggle="dropdown" href="#"> <i class="fa fa-list"></i>
					</a>
					<ul class="dropdown-menu user-detail" role="menu">
						<li> <a href="">Latest</a> </li>
						<li> <a href="">Oldest</a> </li>
					</ul>
				</li>
				<li> <a data-toggle="dropdown" href="#" data-toggle="tooltip" data-placement="left" title="Tooltip on left"><span class="glyphicon glyphicon-trash"></span></a>
					<ul class="dropdown-menu user-detail" role="menu">
						<li> <a href="">Delete Messages</a> </li>
					</ul>
				</li>
			</ul>
			@endif
		</div>
		<div class="lv-body">
			<div class="row content-chat-video">
				@if($isJoin == 1)
				<div class="col-md-7">
					<div class="show-video" id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:580px;">
						<div class="content-video">
							<video width="100%" controls>
								<source src="{{ asset('storage/media/mov_bbb.mp4') }}" type="video/mp4">
								Your browser does not support HTML5 video.
							</video>
							<audio width="100%" controls>
								<source src="{{ asset('storage/media/horse.mp3') }}" type="audio/mpeg">
								Your browser does not support the audio element.
							</audio>
						</div>
						<div class="list-video">

							<ul class="show-list-video" style="list-style: none;">
								<li class="active">
									<a href="">
										<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;It's gives the power to synthesis anything...
									</a>
								</li>
								<li class="">
									<a href="">
										<i class="fa fa-volume-up" aria-hidden="true"></i> &nbsp;We are sharing this knowledge in all ...
									</a>
								</li>
								<li class="">
									<a href="">
										<i class="fa fa-volume-up" aria-hidden="true"></i> &nbsp;Its the ultimate tool to solve any problem....
									</a>
								</li>
								<li class="">
									<a href="">
										<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;We help you excel in that by working with you.
									</a>
								</li>
								<li class="">
									<a href="">
										<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
									</a>
								</li>
								<li class="">
									<a href="">
										<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
									</a>
								</li>
								<li class="">
									<a href="">
										<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
									</a>
								</li>
								<li class="">
									<a href="">
										<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
									</a>
								</li>
								<li class="">
									<a href="">
										<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
									</a>
								</li>
								<li class="">
									<a href="">
										<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
									</a>
								</li>
								<li class="">
									<a href="">
										<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
									</a>
								</li>
								<li class="">
									<a href="">
										<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
									</a>
								</li>
								<li class="">
									<a href="">
										<i class="fa fa-play-circle-o" aria-hidden="true"></i> &nbsp;Similique qui Saepe...
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-5 div-chat">
					<div id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:580px;" class="room-contentt">
						@if($messages->count()>0)
							@foreach($messages as $message)
							<div class="lv-item media @if($message->user_id == Auth::id()) right @else left @endif">
								<div class="lv-avatar @if($message->user_id == Auth::id()) pull-right @else pull-left @endif">
									<img src="{{ url('../storage/avatars/',$message->avatar) }}" alt="">
								</div>
								<div class="media-body">
									<div class="ms-item">
										{!! $message->content !!}
									</div>
									<small class="ms-date">
										<span class="glyphicon glyphicon-time"></span>
										&nbsp; {{ $message->created_at }}
									</small>
								</div>
							</div>
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
	                        <h5><a href="{{ route('frontend.room.join', $room->id) }}" >CLICK HERE TO JOIN THIS ROOM</a></h5>
	                    </div>
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	var currentRoom = {!!json_encode($room)!!};

    $('#mess-content').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == 13) {
			$('#btn-room-reply').click();
            $('#mess-content').reset();
        }
    });
</script>
@endsection