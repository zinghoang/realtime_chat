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
					<span style="color: #818181;"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
				</div>
				<span class="c-black">Room</span>
			</div>
			<ul class="lv-actions actions list-unstyled list-inline">
				<li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" title="Create room"><i class="fa fa-plus"></i> </a></li>
            </ul>
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
            	<div class="modal-dialog">
            		<!-- Modal content-->
            		<div class="modal-content">
            			<div class="modal-header">
            				<button type="button" class="close" data-dismiss="modal">&times;</button>
            				<h4 class="modal-title">Create room...</h4>
            			</div>
            			<form method="post" action="{{ route('frontend.room.store') }}">
            				{{ csrf_field() }}
            				<div class="modal-body">
            					<div class="form-group">
	            					<label for="name">Name:</label>
	            					<input type="text" class="form-control" name="name" id="name">
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
		</div>
		<div class="lv-body">
			<div class="row content-chat-video">
				<div class="col-md-12">
				
					<div class="show-video" id="ms-scrollbar" style="overflow:scroll; overflow-x: hidden; height:530px;">
						@if(count($listRoomJoined) > 0)
						<div class="row">
							<div class="col-md-12">
								<h5 class="text-center">Room you was joined</h5>
								<hr>
							</div>
							@foreach($listRoomJoined as $key => $roomJoined)
								<div class="col-md-4 col-md-offset-2">
									<div class="lv-item media ">
										<a href="{{ route('frontend.message.room', $roomJoined->room->id) }}" title="" style="text-decoration:none;">
										<div class="lv-avatar pull-left"> <img src="{{ asset('images/home.png') }}" alt=""> </div>
										<div class="media-body">
											<div class="lv-title">
												{{ $roomJoined->room->name }} {!! ($roomJoined->room->user_id == Auth::id())?'<span style="color:red">[AD]</span>':'' !!}
												@if($roomJoined->notif == 1)
													<i class="fa fa-star" aria-hidden="true" style="color: #aa1111"></i>
												@endif
											</div>
											<div class="lv-small">Continue the conversation...</div>
										</div>
										</a>
									</div>
								</div>	
							@endforeach
						</div>
							<hr>
						@endif
						<div class="row">
							<div class="col-md-12">
								
								<h5 class="text-center">Some room you can join...</h5>
								<hr>
							</div>
							@if(count($listRoomRandom) == 0)
								<div class="col-md-12">
									<div class="lv-item media ">
										<p class="text-center">No have other group</p>
									</div>
								</div>
							@endif
							@foreach($listRoomRandom as $key => $room)
								<div class="col-md-4 col-md-offset-2">
									<div class="lv-item media ">
										<a href="{{ route('frontend.message.room', $room->id) }}" title="" style="text-decoration:none;">
										<div class="lv-avatar pull-left"> <img src="{{ asset('images/home.png') }}" alt=""> </div>
										<div class="media-body">
											<div class="lv-title">{{ $room->name }}</div>
											<div class="lv-small">Click here to join...</div>
										</div>
										</a>
									</div>
								</div>	
							@endforeach
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
@stop