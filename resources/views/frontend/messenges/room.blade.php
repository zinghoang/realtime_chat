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
				@if($room->user_id == Auth::id())
				<a href="javascript:void(0)" data-toggle="modal" data-target="#editNameRoom" title="Edit the name of room"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

				<!-- Modal Edit Name Room -->
	            <div class="modal fade" id="editNameRoom" role="dialog">
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
					<form method="post" action="{{ route('frontend.message.uploadfile', $room->id) }}" enctype="multipart/form-data" id="upload-file">
						{{ csrf_field() }}
						<label for="upload">
							<i class="fa fa-upload" aria-hidden="true"></i> 
							<input type="file" id="upload" name="title" style="display:none" onchange="event.preventDefault(); document.getElementById('upload-file').submit();">
						</label>
				    </form>

				    @if($errors->count()>0)
				    	@php
				    		$errorAlert = '';
				    	@endphp

				    	@foreach($errors->all() as $error)
		                    @php
		                    	$errorAlert .= $error;
		                    @endphp
		                @endforeach
				    	<script type="text/javascript">
				    		alert('{{$errorAlert}}')
			            </script>
			        @endif
					
				</li>
				<li>
					<a href="javascript:void(0)" data-toggle="modal" data-target="#inviteFriend" title="Invite friend"><i class="fa fa-envelope" aria-hidden="true"></i></a>
				</li>

				@if($room->user_id == Auth::id())
				
					<li> 




						<a href="{{ route('frontend.room.destroy', $room->id) }}" 
			                onclick="event.preventDefault(); document.getElementById('destroy-room').submit();" style="text-decoration: none;">
			                <span class="glyphicon glyphicon-trash"></span>
			            </a>
		            <form id="destroy-room" action="{{ route('frontend.room.destroy', $room->id) }}" method="POST" style="display: none;">
		                {{ csrf_field() }}
		                <input name="_method" type="hidden" value="DELETE">
		            </form>



					</li>
					
				@endif
			</ul>
			<!-- Modal Invite Room -->
	            <div class="modal fade" id="inviteFriend" role="dialog">
	            	<div class="modal-dialog">
	            		<!-- Modal content-->
	            		<div class="modal-content">
	            			<div class="modal-header">
	            				<button type="button" class="close" data-dismiss="modal">&times;</button>
	            				<h4 class="modal-title">Invite friend...</h4>
	            			</div>
	            			<form method="post" action="">
	            				{{ csrf_field() }}
	            				<div class="modal-body">
	            					<div class="form-group">
		            					<label for="name">Name:</label>
		            					<input type="text" class="form-control" name="name" id="name" value="">
	            					</div>
		            			</div>
		            			<div class="modal-footer">
		            				<button type="submit" class="btn btn-info">Invite</button>
		            				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		            			</div>
	            			</form>
	            		</div>
	            	</div>
	            </div>
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
								@foreach ($listFile as $key => $file)
									
								<li class="">
									<a href="">
										<i class="fa {{ ($file->type=='video') ?'fa-play-circle-o':'fa-volume-up' }}" aria-hidden="true"></i> &nbsp;{{ $file->title }}
									</a>
								</li>
								@endforeach
								
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