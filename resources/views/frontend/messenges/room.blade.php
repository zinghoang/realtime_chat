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
				<div class="lv-avatar pull-left"> <img src="{{ asset('images/home.png') }}" alt=""> </div><span class="c-black">{{ $room->name }}</span>
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
					<div id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:580px;">
						<div class="lv-item media right">
							<div class="lv-avatar pull-right"> 
								<img src="{{ asset('images/avatar.jpg') }}" alt=""> 
							</div>
							<div class="media-body">
								<div class="ms-item"> 
									We started this site with clear mission that we want to deliver complete details knowledge of Programming to our audience. We are sharing this knowledge in all areas that you can see in our site. 
								</div>
								<small class="ms-date">
									<span class="glyphicon glyphicon-time"></span>
									&nbsp; 05/10/2015 at 09:30
								</small> 
							</div>
						</div>
						<div class="lv-item media">
							<div class="lv-avatar pull-left"> 
								<img src="{{ asset('images/bhai.jpg') }}" alt=""> 
							</div>
							<div class="media-body">
								<div class="ms-item"> 
									It's gives the power to synthesis anything anywhere you want to. Its the ultimate tool to solve any problem. And we help you excel in that by working with you. 
								</div>
								<small class="ms-date">
									<span class="glyphicon glyphicon-time"></span>
									&nbsp; 20/02/2015 at 09:33
								</small> 
							</div>
						</div>
						<div class="lv-item media">
							<div class="lv-avatar pull-left"> 
								<img src="{{ asset('images/bhai.jpg') }}" alt=""> 
							</div>
							<div class="media-body">
								<div class="ms-item"> 
									It's gives the power to synthesis anything anywhere you want to. Its the ultimate tool to solve any problem. And we help you excel in that by working with you. 
								</div>
								<small class="ms-date">
									<span class="glyphicon glyphicon-time"></span>
									&nbsp; 20/02/2015 at 09:33
								</small> 
							</div>
						</div>
						<div class="lv-item media">
							<div class="lv-avatar pull-left"> 
								<img src="{{ asset('images/bhai.jpg') }}" alt=""> 
							</div>
							<div class="media-body">
								<div class="ms-item"> 
									It's gives the power to synthesis anything anywhere you want to. Its the ultimate tool to solve any problem. And we help you excel in that by working with you. 
								</div>
								<small class="ms-date">
									<span class="glyphicon glyphicon-time"></span>
									&nbsp; 20/02/2015 at 09:33
								</small> 
							</div>
						</div>
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
</script>
@endsection